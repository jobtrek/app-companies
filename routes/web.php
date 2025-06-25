<?php

use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/createcomments', function () {
    return view('createcomments');
});

Route::get('/createaccount', function () {
    return view('createaccount');
  
Route::get('/', function () {
    return view('homepage');
});

Route::get('/profil-entreprise', function () {
    return view('profileEntreprise');
});

Route::get('/userProfile', function () {
    return view('userProfile');
});

Route::get('/commentDetails', function () {
    return view('commentDetails');
});

Route::get('/coachApprenticeProfile', function () {
    return view('coachApprenticeProfile');
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/profileEntreprise/{entreprise}', [EntrepriseController::class, 'index'])->name('profileEntreprise');

Route::get('/', [UserController::class, 'index'])->name('home');
