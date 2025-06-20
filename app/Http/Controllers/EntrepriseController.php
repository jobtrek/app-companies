<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    public function index($id)
    {
        $entreprise = Entreprise::all()->where('id', $id)->firstOrFail();

        return view('profileEntreprise', ['entreprise' => $entreprise]);
    }
}
