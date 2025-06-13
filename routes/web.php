<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::post('/login', [UserController::class, 'login'])->name('login');
