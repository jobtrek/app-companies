<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Models\Commentaire;
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
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
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
        $apprentis = User::whereNotNull('coach_id')->with('commentaires')->get();
        return view('coach', ['apprentis' => $apprentis ]);
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

        $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')->orWhereJsonContains('roles', 'apprenti_commerce')->get();

        if ($sort == 'entreprise') {
            $apprenties->whereNotIn('entreprise', ['Centre de formation Jobtrek']);
        } elseif ($sort == 'formation') {
            $apprenties->whereNotIn('entreprise', 'Centre de formation Jobtrek');
        } elseif ($sort == 'alphabetique') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')->orWhereJsonContains('roles', 'apprenti_commerce')->orderBy('name', 'ASC')->get();
        } elseif ($sort == 'informaticien-dev') {

            $apprenties = User::whereJsonContains('roles', 'apprenti_informaticien')->get();
        } elseif ($sort == 'employe-com') {
            $apprenties = User::whereJsonContains('roles', 'apprenti_commerce')->get();
        } else {
            return back()->withErrors(['Choisissez un filtre valable.']);
        }

        return view('homepage', ['apprentis' => $apprenties, 'filtres' => $filtres]);
    }

    public function commentsdetails($id)
    {
        $commentaire = Commentaire::all()->find($id);

        $user = User::all()->where('id', $commentaire->apprentis_id)->firstOrFail();
         return view('commentDetails', ['comments' => $commentaire,'user'=>$user ] );
    }
}
