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

Route::get('/create-comment', function () {
    return view('createcomments');
});

Route::get('/company-profile', function () {
    return view('profileEntreprise');
});

Route::get('/user-profile', function () {
    return view('userProfile');
});

Route::get('/comments-detail', function () {
    return view('commentDetails');
});

Route::get('/coach', function () {
    return view('coach');
});

Route::get('/create-account', function () {
    return view('createaccount');
});

Route::get('/create-company', function () {
    return view('createCompany');
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/profileEntreprise/{entreprise}', [EntrepriseController::class, 'index'])->name('profileEntreprise');

Route::get('/', [UserController::class, 'index'])->name('home');
