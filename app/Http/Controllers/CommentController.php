<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreationRequest;
use App\Models\Commentaire;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function comment(CommentCreationRequest $request, $id)
    {
        $validated = $request->validated();
        $coachId = auth()->id();
        $validated['coach_id'] = $coachId;
        $validated['apprentis_id'] = $id;
        Commentaire::create($validated);
        return redirect()->route('coach')->with('success', 'Commentaire créé avec succès !');

    }

    public function commentview($id)
    {
        $user = User::findOrFail($id);
        return view('createcomments', ['user' => $user]);
    }

}
