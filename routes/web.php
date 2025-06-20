<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('homepage');
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/', [UserController::class, 'index'])->name('home');
