<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntrepriseCreationRequest;
use App\Models\Domain;
use App\Models\Entreprise;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
{
    use AuthorizesRequests;

    public function index($id)
    {
        $entreprise = Entreprise::all()->where('id', $id)->firstOrFail();
        $domains = Domain::all();

        return view('profileEntreprise', ['entreprise' => $entreprise, 'domains' => $domains]);
    }

    public function create(EntrepriseCreationRequest $request)
    {
        $newEntreprise = Entreprise::create($request->validated());
        $path = Storage::disk('local')->putFile('entreprise-logo', $request->file('photo'));
        $newEntreprise->photo = $path;
        $newEntreprise->save();

        return redirect()->route('home')->with('success', 'Entreprise créée !');
    }

    public function showCreateForm()
    {
        $domains = Domain::all();

        return view('createCompany', ['domains' => $domains]);
    }

    public function update(EntrepriseCreationRequest $request, Entreprise $entreprise)
    {
        $this->authorize('admin');

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($entreprise->photo) {
                Storage::disk('local')->delete($entreprise->photo);
            }
            $path = Storage::disk('local')->putFile('entreprise-logo', $request->file('photo'));
            $data['photo'] = $path;
        }

        $entreprise->update($data);

        return redirect()->route('profileEntreprise', $entreprise)->with('success', 'Entreprise mise à jour avec succès');
    }

    public function destroy(Entreprise $entreprise)
    {
        $this->authorize('admin');

        $entreprise->users()->update(['entreprise_id' => 1]);

        $entreprise->delete();

        return redirect()->route('home')->with('success', 'Entreprise supprimée');
    }
}
