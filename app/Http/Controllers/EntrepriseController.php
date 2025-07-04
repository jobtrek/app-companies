<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreationRequest;
use App\Models\Domain;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Storage;

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

        Entreprise::create($request->all());

        return redirect()->route('home')->with('success', 'Entreprise créée !');
    }

    public function showCreateForm()
    {
        $domains = Domain::all();

        return view('createCompany', ['domains' => $domains]);
    }
}
