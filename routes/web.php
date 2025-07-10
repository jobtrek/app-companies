<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth'])->group(function() {
    Route::get('/create-account', [UserController::class, 'showDomain'])->name('create-account');
    Route::get('/profileEntreprise/{entreprise}', [EntrepriseController::class, 'index'])->name('profileEntreprise');
    Route::get('/create-company', [EntrepriseController::class, 'showCreateForm'])->name('create-company');
    Route::get('/user-profile/{id}', [UserController::class, 'show'])->name('userProfile');
});

Route::middleware(EnsureUserHasRole::class . ':coach')->group(function() {
    Route::get('/coach', [UserController::class, 'coach'])->name('coach')->middleware(EnsureUserHasRole::class. ':coach');
    Route::get('/comments-detail/{id}', [CommentController::class, 'commentsdetails'])->name('comment.detail')->middleware(EnsureUserHasRole::class . ':coach');
    Route::get('/create-comment/{id}', [CommentController::class, 'commentview'])->name('create.comment.view')->middleware(EnsureUserHasRole::class . ':coach');
    Route::post('/create-comment/{id}', [CommentController::class, 'comment'])->name('create.comment')->middleware(EnsureUserHasRole::class . ':coach');
    Route::delete('/delete-comment/{commentaire}', [CommentController::class, 'destroyComment'])->name('delete.comment')->middleware(EnsureUserHasRole::class . ':coach');
    Route::get('/edit-comment/{commentaire}', [CommentController::class, 'editComment'])->name('comment.edit')->middleware(EnsureUserHasRole::class . ':coach');
    Route::put('/Update-comment/{commentaire}', [CommentController::class, 'updateComment'])->name('comment.update')->middleware(EnsureUserHasRole::class . ':coach');
});

Route::middleware(EnsureUserHasRole::class . ':formateur_commerce,formateur_informaticien')->group(function() {
    Route::put('/updatecoach/{user}', [UserController::class, 'updateCoach'])->name('users.updateCoach');
    Route::put('/updateentreprise/{user}', [UserController::class, 'updateEntreprise'])->name('users.updateEntreprise');
    Route::put('/update-company/{entreprise}', [EntrepriseController::class, 'update', 'showCreateForm'])->name('company.update');
    Route::get('/user-profile-update/{id}', [UserController::class, 'userUpdateShow'])->name('users.edit');
});

Route::middleware(EnsureUserHasRole::class . ':admin')->group(function() {
    Route::post('/creation', [UserController::class, 'create'])->name('creation')->middleware(EnsureUserHasRole::class . ':admin');
    Route::post('/create-new-company', [EntrepriseController::class, 'create'])->name('company.create')->middleware(EnsureUserHasRole::class . ':admin');
    Route::post('/create-account', [UserController::class, 'create'])->name('user.create')->middleware(EnsureUserHasRole::class . ':admin');
    Route::delete('/delete-account/{user}', [UserController::class, 'destroy'])->name('users.delete')->middleware(EnsureUserHasRole::class . ':admin');
    Route::delete('/delete-company/{entreprise}', [EntrepriseController::class, 'destroy'])->name('company.delete')->middleware(EnsureUserHasRole::class . ':admin');
});

Route::view('/login', 'login')->name('login.view');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/sort/{sort}', [UserController::class, 'sort'])->name('home.sort');

Route::put('/users/{user}', [UserController::class, 'updateProfil'])->name('users.update')->middleware(EnsureUserHasRole::class . ':admin,formateur_commerce,formateur_informaticien');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
