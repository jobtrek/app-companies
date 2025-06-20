<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Models\Apprenti;
use App\Models\Coach;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(UserCreationRequest $request)
    {
        $role = $request->input('role');
        if (str_contains($role, 'Apprenti')) {
            Apprenti::create($request->all());
        } elseif (str_contains($role, 'Formateur')) {
            Formateur::create($request->all());
        } elseif (str_contains($role, 'Coach')) {
            Coach::create($request->all());
        } else {
            return back()->withErrors(['role' => 'Role invalid']);
        }

        return back();
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'role' => 'required|in:Apprenti,Formateur,Coach',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($credentials['role'] === 'Apprenti' || $credentials['role'] === 'Formateur' || $credentials['role'] === 'Coach') {
            User::attemptLogin($credentials);
        } else {
            return back()->withErrors(['role' => 'Login role invalid']);
        }
    }
}
