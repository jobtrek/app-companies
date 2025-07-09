<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');

Route::view('/login', 'login')->name('login.view');
Route::view('/create-account', 'createaccount')->name('create-account');
Route::view('/company-profile', 'profileEntreprise')->name('company-profile');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/creation', [UserController::class, 'create'])->name('creation');

Route::get('/profileEntreprise/{entreprise}', [EntrepriseController::class, 'index'])->name('profileEntreprise');
Route::get('/create-company', [EntrepriseController::class, 'showCreateForm'])->name('create-company');
Route::post('/create-new-company', [EntrepriseController::class, 'create'])->name('company.create');

Route::get('/user-profile/{id}', [UserController::class, 'show'])->name('userProfile');

Route::get('/coach', [UserController::class, 'coach'])->name('coach');
Route::get('/sort/{sort}', [UserController::class, 'sort'])->name('home.sort');
Route::get('/comments-detail/{id}', [CommentController::class, 'commentsdetails'])->name('comment.detail');

Route::get('/create-comment/{id}', [CommentController::class, 'commentview'])->name('create.comment.view');
Route::post('/create-comment/{id}', [CommentController::class, 'comment'])->name('create.comment');
Route::delete('/delete-comment/{commentaire}', [CommentController::class, 'destroyComment'])->name('delete.comment');
Route::get('/edit-comment/{commentaire}', [CommentController::class, 'editComment'])->name('comment.edit');
Route::put('/Update-comment/{commentaire}', [CommentController::class, 'updateComment'])->name('comment.update');


Route::put('/updatecoach/{user}', [UserController::class, 'updateCoach'])->name('users.updateCoach');
Route::put('/updateentreprise/{user}', [UserController::class, 'updateEntreprise'])->name('users.updateEntreprise');
Route::put('/update-company/{entreprise}', [EntrepriseController::class, 'update', 'showCreateForm'])->name('company.update');

Route::get('/create-account', [UserController::class, 'showDomain'])->name('create-account');
Route::post('/create-account', [UserController::class, 'create'])->name('user.create');

Route::delete('/delete-account/{user}', [UserController::class, 'destroy'])->name('users.delete');
Route::delete('/delete-company/{entreprise}', [EntrepriseController::class, 'destroy'])->name('company.delete');

Route::get('/user-profile-update/{id}', [UserController::class, 'userUpdateShow'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'updateProfil'])->name('users.update');

Route::post('/logout', function () {
    Auth::logout(); 
    return redirect('/');
})->name('logout');