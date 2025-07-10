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
        if ($request->hasFile('file')) {
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

    public function commentview($id)
    {
        $user = auth()->user();
        $user = User::findOrFail($id);

        return view('createcomments', ['user' => $user]);
    }

    public function commentsdetails($id)
    {
        $commentaire = Commentaire::find($id);
        $user = User::find($commentaire->apprentis_id);
        $commentFiles = File::where('filename', 'comment - ' . $commentaire->id)->get();
        return view('commentDetails', ['comments' => $commentaire, 'user' => $user, 'commentFiles' => $commentFiles->all()]);
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
        $user = auth()->user();
        $commentaire->delete();
        return redirect()->route('coach')->with('success', 'Commentaire supprimée avec succès !');

    }

    public function editComment(Commentaire $commentaire)
    {
        $user = auth()->user();
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
