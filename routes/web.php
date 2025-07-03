<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/create-comment', function () {
    return view('createcomments');
});

Route::get('/company-profile', function () {
    return view('profileEntreprise');
});
Route::get('/coach', function () {
    return view('coach');
})->name('coach');

Route::get('/create-account', function () {
    return view('createaccount');
})->name('create-account');

Route::get('/create-company', function () {
    return view('createCompany');
})->name('create-company');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/profileEntreprise/{entreprise}', [EntrepriseController::class, 'index'])->name('profileEntreprise');
Route::post('create-new-company', [EntrepriseController::class, 'create'])->name('company.create');

Route::get('/user-profile/{id}', [UserController::class, 'show'])->name('userProfile');

Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/coach', [UserController::class, 'coach'])->name('coach');

Route::get('sort/{sort}', [UserController::class, 'sort'])->name('home.sort');

Route::get('/comments-detail/{id}', [UserController::class, 'commentsdetails'])->name('comment.detail');

Route::get('/create-comment/{id}', [CommentController::class, 'commentview'])->name('create.comment.view');
Route::post('/create-comment/{id}', [CommentController::class, 'comment'])->name('create.comment');

Route::put('/updatecoach/{user}', [UserController::class, 'updateCoach'])->name('users.updateCoach');
