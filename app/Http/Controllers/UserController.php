<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(UserCreationRequest $request)
    {
        User::create($request->all());

        return redirect()->intended('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required']
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credential do not match our records:(',
        ])->onlyInput('email');
    }

    public function index()
    {
        $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')->orWhereJsonContains('roles', 'apprenti_commerce')->get();

        $filtres = [
            'entreprise' => 'En entreprise',
            'formation' => 'En centre de formation',
            'alphabetique' => 'Par ordre alphabétique',
            'informaticien-dev' => 'Informaticien développement',
            'employe-com' => 'Employé de commerce',
        ];

        return view('homepage', ['apprentis' => $apprenties, 'filtres' => $filtres]);
    }

    public function coach()
    {
        $apprentis = User::all()->whereNotNull('coach_id');

        return view('coach', ['apprentis' => $apprentis]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('userProfile', ['user' => $user]);
    }

    public function sort($sort)
    {
        $filtres = [
            'entreprise' => 'En entreprise',
            'formation' => 'En centre de formation',
            'alphabetique' => 'Par ordre alphabétique',
            'informaticien-dev' => 'Informaticien développement',
            'employe-com' => 'Employé de commerce',
        ];

        $apprenties = [];
        if($sort == 'entreprise') {
            $apprenties = User::all()->whereNotIn('enterprise', ['Centre de formation Jobtrek']);
        } else if($sort == 'formation') {
            $apprenties = User::all()->where('enterprise', 'Centre de formation Jobtrek');
        } else if($sort == 'alphabetique') {
            $apprenties = User::all()->sortBy('name');
        } else if($sort == 'informaticien-dev') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')->get();
        } else if($sort == 'employe-com') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_commerce')->get();
        } else {
            return back()->withErrors(['Choisissez un filtre valable.']);
        }


        return view('homepage', ['apprentis' => $apprenties, 'filtres' => $filtres]);
    }
}
