<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
        public function create()
    {
        $domains = Domain::all();
        return view('createDomains', ['domains' => $domains]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:domains,name',
        ]);

        Domain::create($validated);

        return redirect()->route('domain.create')->with('success', 'Domaine créé avec succès.');
    }
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domain.create')->with('success', 'Domaine supprimé avec succès.');
    }
}
