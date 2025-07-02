<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreationRequest;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EntrepriseController extends Controller
{
    public function index($id)
    {
        $entreprise = Entreprise::all()->where('id', $id)->firstOrFail();

        return view('profileEntreprise', ['entreprise' => $entreprise]);
    }

    public function create(EntrepriseCreationRequest $request)
    {
        $newEntreprise = Entreprise::create($request->validated());
        $path = Storage::disk('local')->putFile('entreprise-logo', $request->file('photo'));
        $newEntreprise->photo = $path;
        $newEntreprise->save();

        return redirect('/');
    }
}
