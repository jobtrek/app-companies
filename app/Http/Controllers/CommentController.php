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

    public function comment(CommentCreationRequest $request, $apprentiId)
    {
        $coachId = auth()->id();
        $apprenti = User::findOrFail($apprentiId);

        $this->authorize('manage-comment', $apprenti);


        $validated = $request->validated();
        $validated['coach_id'] = $coachId;
        $validated['apprentis_id'] = $apprentiId;

        $comment = Commentaire::create($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = Storage::disk('local')->putFile('commentFiles/', $file);
                $comment->file()->create([
                    'path' => $path,
                    'filename' => 'comment - ' . $comment->id,
                ]);
            }
        }

        return redirect()->route('coach')->with('success', 'Commentaire créé avec succès !');
    }

    public function commentview($apprentiId)
    {
        $apprenti = User::findOrFail($apprentiId);

        $this->authorize('manage-comment', $apprenti);


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
        $apprenti = User::findOrFail($commentaire->apprentis_id);

        $this->authorize('manage-comment', $apprenti);


        $files = $commentaire->file;
        foreach ($files as $file) {
            Storage::disk('local')->delete($file->path);
            $file->delete();
        }

        $commentaire->delete();

        return redirect()->route('coach')->with('success', 'Commentaire supprimé avec succès !');
    }

    public function editComment(Commentaire $commentaire)
    {
        $apprenti = User::findOrFail($commentaire->apprentis_id);

        $this->authorize('manage-comment', $apprenti);


        return view('createcommentsUpdate', ['user' => $apprenti, 'comment' => $commentaire]);
    }

    public function updateComment(CommentCreationRequest $request, Commentaire $commentaire)
    {
        $apprenti = User::findOrFail($commentaire->apprentis_id);

        $this->authorize('manage-comment', $apprenti);


        $validated = $request->validated();
        $commentaire->title = $validated['title'];
        $commentaire->description = $validated['description'];

        if ($request->hasFile('files')) {
            $commentFiles = $commentaire->file;
            foreach ($commentFiles as $file) {
                Storage::disk('local')->delete($file->path);
                $file->delete();
            }

            foreach ($commentFiles as $file) {
                $path = Storage::disk('local')->putFile('commentFiles', $file);
                $commentaire->file()->create([
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
        return Commentaire::where('apprentis_id', $apprentiId)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function showCommentsByApprenti($apprentiId)
    {
        $apprenti = User::findOrFail($apprentiId);

        $this->authorize('manage-comment', $apprenti);


        $comments = $this->getCommentsByCoachForApprenti($apprentiId);

        return view('commentsList', [
            'user' => $apprenti,
            'comments' => $comments,
        ]);
    }
}
