<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Commentaire;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    use AuthorizesRequests;

    private function checkCoachAuthorization(User $apprenti)
    {
        $coach = auth()->user();

        if (!$coach->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous devez être coach pour accéder à cette page.");
        }

        if ($apprenti->coach_id !== $coach->id) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous ne pouvez accéder qu'à vos propres apprentis.");
        }

        return null;
    }

    public function comment(CommentCreationRequest $request, $apprentiId)
    {
        $coachId = auth()->id();
        $apprenti = User::findOrFail($apprentiId);

        if ($authCheck = $this->checkCoachAuthorization($apprenti)) {
            return $authCheck;
        }

        $validated = $request->validated();
        $validated['coach_id'] = $coachId;
        $validated['apprentis_id'] = $apprentiId;

        $comment = Commentaire::create($validated);

        if ($request->hasFile('files')) {
            if ($validated['files']) {
                foreach ($validated['files'] as $file) {
                    $path = Storage::disk('local')->putFile('commentFiles/', $file);
                    $comment->file()->create([
                        'path' => $path,
                        'filename' => 'comment - ' . $comment->id,
                    ]);
                }

            }
        }

        return redirect()->route('coach')->with('success', 'Commentaire créé avec succès !');
    }

    public function commentview($apprentiId)
    {
        $apprenti = User::findOrFail($apprentiId);

        if ($authCheck = $this->checkCoachAuthorization($apprenti)) {
            return $authCheck;
        }

        return view('createcomments', ['user' => $apprenti]);
    }

    public function commentsdetails($commentaireId)
    {
        $commentaire = Commentaire::findOrFail($commentaireId);
        $user = User::findOrFail($commentaire->apprentis_id);
        $commentFiles = File::where('filename', 'comment - ' . $commentaire->id)->get();

        return view('commentDetails', [
            'comments' => $commentaire,
            'user' => $user,
            'commentFiles' => $commentFiles,
        ]);
    }

    public function commentFileDisplay($filename)
    {
        $path = "commentFiles/" . $filename;

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->response($path);
    }

    public function destroyComment(Commentaire $commentaire)
    {
        $coachId = auth()->id();

        if ($commentaire->coach_id !== $coachId) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous ne pouvez supprimer que vos propres commentaires.");
        }

        $files = $commentaire->files;
        foreach ($files as $file) {
            Storage::disk('local')->delete($file->path);
            $file->delete();
        }

        $commentaire->delete();

        return redirect()->route('coach')->with('success', 'Commentaire supprimé avec succès !');
    }

    public function editComment(Commentaire $commentaire)
    {
        $coach = auth()->user();

        if (!$coach->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous devez être coach pour modifier un commentaire.");
        }

        if ($commentaire->coach_id !== $coach->id) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous ne pouvez modifier que vos propres commentaires.");
        }

        $apprenti = User::findOrFail($commentaire->apprentis_id);

        return view('createcommentsUpdate', ['user' => $apprenti, 'comment' => $commentaire]);
    }

    public function updateComment(CommentCreationRequest $request, Commentaire $commentaire)
    {
        $coach = auth()->user();

        if (!$coach->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous devez être coach pour modifier un commentaire.");
        }

        if ($commentaire->coach_id !== $coach->id) {
            return redirect()->route('coach')->with('error', "Accès refusé : vous ne pouvez modifier que vos propres commentaires.");
        }

        $validated = $request->validated();
        $commentaire->title = $validated['title'];
        $commentaire->description = $validated['description'];

        if ($request->hasFile('files')) {
            // Supprimer anciens fichiers liés au commentaire
            $commentFiles = $commentaire->files;
            foreach ($commentFiles as $file) {
                Storage::disk('local')->delete($file->path);
                $file->delete();
            }

            foreach ($request->file('files') as $file) {
                $path = Storage::disk('local')->putFile('commentFiles', $file);
                $commentaire->files()->create([
                    'path' => $path,
                    'filename' => 'comment - ' . $commentaire->id,
                ]);
            }
        }

        $commentaire->save();

        return redirect()->route('coach')->with('success', 'Commentaire modifié avec succès !');
    }

    public function getCommentsByCoachForApprenti($apprentiId)
    {
        $coachId = auth()->id();

        return Commentaire::where('apprentis_id', $apprentiId)
                    ->where('coach_id', $coachId)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function showCommentsByApprenti($apprentiId)
    {
        $apprenti = User::findOrFail($apprentiId);

        if ($authCheck = $this->checkCoachAuthorization($apprenti)) {
            return $authCheck;
        }

        $comments = $this->getCommentsByCoachForApprenti($apprentiId);

        return view('commentsList', [
            'user' => $apprenti,
            'comments' => $comments,
        ]);
    }
}
