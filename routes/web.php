<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DomainController;
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
    Route::get('/comment-file/{filename}', [CommentController::class, 'commentFileDisplay'])->name('comment-file.show')->where('filename', '.*');
});

Route::middleware(EnsureUserHasRole::class . ':coach')->group(function() {
    Route::get('/coach', [UserController::class, 'coach'])->name('coach');
    Route::get('/comments-detail/{id}', [CommentController::class, 'commentsdetails'])->name('comment.detail');
    Route::get('/create-comment/{id}', [CommentController::class, 'commentview'])->name('create.comment.view');
    Route::post('/create-comment/{id}', [CommentController::class, 'comment'])->name('create.comment');
    Route::delete('/delete-comment/{commentaire}', [CommentController::class, 'destroyComment'])->name('delete.comment');
    Route::get('/edit-comment/{commentaire}', [CommentController::class, 'editComment'])->name('comment.edit');
    Route::put('/update-comment/{commentaire}', [CommentController::class, 'updateComment'])->name('comment.update');
    Route::get('/coach/apprenti/{id}/comments', [CommentController::class, 'showCommentsByApprenti'])->name('coach.apprenti.comments');
});

Route::middleware(EnsureUserHasRole::class . ':formateur_commerce,formateur_informaticien')->group(function() {
    Route::put('/updatecoach/{user}', [UserController::class, 'updateCoach'])->name('users.updateCoach');
    Route::put('/updateentreprise/{user}', [UserController::class, 'updateEntreprise'])->name('users.updateEntreprise');
    Route::put('/update-company/{entreprise}', [EntrepriseController::class, 'update'])->name('company.update');
    Route::get('/create-company', [EntrepriseController::class, 'showCreateForm'])->name('create-company');
    Route::delete('/delete-company/{entreprise}', [EntrepriseController::class, 'destroy'])->name('company.delete');
    Route::get('/user-profile-update/{id}', [UserController::class, 'userUpdateShow'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'updateProfil'])->name('users.update');
});

Route::middleware(EnsureUserHasRole::class . ':admin')->group(function() {
    Route::post('/creation', [UserController::class, 'create'])->name('creation');
    Route::post('/create-account', [UserController::class, 'create'])->name('user.create');
    Route::delete('/delete-account/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/create-domain', [DomainController::class, 'create'])->name('domain.create');
    Route::post('/domains', [DomainController::class, 'store'])->name('domains.store');
    Route::delete('/delete-domain/{domain}', [DomainController::class, 'destroy'])->name('domain.delete');
});


Route::view('/login', 'login')->name('login.view');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/sort/{sort}', [UserController::class, 'sort'])->name('home.sort');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/searchUser', [UserController::class, 'searchUser'])->name('search.user');
