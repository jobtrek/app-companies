<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Models\Apprenti;
use App\Models\Coach;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(UserCreationRequest $request)
    {
        $role = $request->input('role');
        if (Str::contains($role, 'Apprenti')) {
            Apprenti::create($request->all());
        } else if(Str::contains($role, 'Formateur')) {
            Formateur::create($request->all());
        } else if(Str::contains($role, 'Coach')) {
            Coach::create($request->all());
        } else {
            return back()->withErrors(['role' => 'Role invalid']);
        }
        return back();
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'role' => 'required|in:Apprenti-Commerce,Apprenti-Informaticien,Formateur-Commerce,Formateur-Informaticien,Coach',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($credentials['role'] === 'Apprenti-Commerce' ||
            $credentials['role'] === 'Apprenti-Informaticien' ||
            $credentials['role'] === 'Formateur-Commerce' ||
            $credentials['role'] === 'Formateur-Informaticien' ||
            $credentials['role'] === 'Coach') {
            User::attemptLogin($credentials);
        } else {
            return back()->withErrors(['role' => 'Login role invalid']);
        }
    }

    public function index()
    {
        $apprentis = Apprenti::all();

        return view('homepage', ['apprentis' => $apprentis]);
    }
}
