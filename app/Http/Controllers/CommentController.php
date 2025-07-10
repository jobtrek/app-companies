<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Commentaire;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    use AuthorizesRequests;

    //
    public function comment(CommentCreationRequest $request, $id)
    {

        $validated = $request->validated();
        $coachId = auth()->id();
        $validated['coach_id'] = $coachId;
        $validated['apprentis_id'] = $id;
        $comment = Commentaire::create($validated);
        if ($validated['files']) {
            foreach ($validated['files'] as $file) {
                $path = Storage::disk('local')->putFile('commentFiles/', $file);
                $comment->file()->create([
                    'path' => $path,
                    'filename' => 'comment - ' . $comment->id,
                ]);
            }
        }

        return redirect()->route('coach')->with('success', 'Commentaire créé avec succès !');

    }

    public function commentview($id)
    {
        $user = auth()->user();
        if (!$user->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Vous n'avez pas les accés nécesssaire pour l'ajout de commentaire.");
        }
        $user = User::findOrFail($id);

        return view('createcomments', ['user' => $user]);
    }

    public function commentsdetails($id)
    {
        $user = auth()->user();
        if (!$user->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Vous n'avez pas les accès pour voir les commentaires.");
        }
        $commentaire = Commentaire::all()->find($id);

        $user = User::all()->where('id', $commentaire->apprentis_id)->firstOrFail();

        return view('commentDetails', ['comments' => $commentaire, 'user' => $user]);
    }

    public function destroyComment(Commentaire $commentaire)
    {
        $user = auth()->user();
        if (!$user->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Vous n'avez pas les accès pour supprimée les commentaires.");
        }

        $commentaire->delete();
        return redirect()->route('coach')->with('success', 'Commentaire supprimée avec succès !');

    }

    public function editComment(Commentaire $commentaire)
    {
        $user = auth()->user();
        if (!$user->roles->contains('coach')) {
            return redirect()->route('coach')->with('error', "Vous n'avez pas les accès à la modification.");
        }
        return view('createcommentsUpdate', ['user' => $user, 'comment' => $commentaire]);

    }

    public function updateComment(CommentCreationRequest $request, Commentaire $commentaire)
    {
        $validated = $request->validated();
        $commentaire->title = $validated['title'];
        $commentaire->description = $validated['description'];
        if ($request->hasFile('file')) {
            if ($validated['files']) {
                $commentFiles = File::where('filename', 'comment - ' . $commentaire->id)->get();
                foreach ($commentFiles as $file) {
                    Storage::disk('local')->delete($file->path);
                    File::destroy($file->id);
                }
                foreach ($validated['files'] as $file) {
                    $path = Storage::disk('local')->putFile('commentFiles/', $file);
                    $commentaire->file()->create([
                        'path' => $path,
                        'filename' => 'comment - ' . $commentaire->id,
                    ]);
                }
            }

        } else {

        }

        $commentaire->save();

        return redirect()->route('coach')->with('success', 'Commentaire édité avec succès !');
    }
}
