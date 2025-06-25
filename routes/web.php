<?php

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
});


Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/', [UserController::class, 'index'])->name('home');
