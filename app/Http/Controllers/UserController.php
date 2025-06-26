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
        $apprenties = User::whereJsonContains('roles', 'coach')->get();

        return view('homepage', ['apprentis' => $apprenties]);
    }

    public function coach()
    {
        $users = User::all();
        $apprenties = $users->filter(function ($user) {
            return $user->roles->contains('coach');
        });

        return view('coach', ['apprentis' => $apprenties]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('userProfile', ['user' => $user]);
    }
}
