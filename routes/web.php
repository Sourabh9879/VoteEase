<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElectionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');

Route::post('/signup', [UserController::class, 'register'])->name('signup.post');

Route::middleware(['auth'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/results', [VoteController::class, 'getVoteCount'])->name('user.results');
    Route::get('/user/candidates', [CandidateController::class, 'showCandidate'])->name('user.candidates');
    Route::post('/user/vote/{id}', [VoteController::class, 'voteCandidate'])->name('user.vote.candidate');
    Route::get('/user/elections', [ElectionController::class, 'userViewElections'])->name('user.elections');
    Route::get('/user/elections/{id}', [ElectionController::class, 'userViewElection'])->name('user.elections.view');

    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [UserController::class, 'showUser'])->name('admin.users');
        Route::get('/results', [VoteController::class, 'getVoteCount'])->name('admin.results');
        Route::get('/candidates', [CandidateController::class, 'manageCandidate'])->name('admin.candidates');
        Route::post('/candidates', [CandidateController::class, 'addCandidate'])->name('admin.candidates.add');
        Route::get('/candidates/{id}/edit', [CandidateController::class, 'editCandidate'])->name('admin.candidates.edit');
        Route::put('/candidates/{id}', [CandidateController::class, 'updateCandidate'])->name('admin.candidates.update');
        Route::delete('/candidates/{id}', [CandidateController::class, 'deleteCandidate'])->name('admin.candidates.delete');
        
        Route::get('/elections', [ElectionController::class, 'index'])->name('admin.elections.index');
        Route::get('/elections/create', [ElectionController::class, 'create'])->name('admin.elections.create');
        Route::post('/elections', [ElectionController::class, 'store'])->name('admin.elections.store');
        Route::get('/elections/{id}', [ElectionController::class, 'show'])->name('admin.elections.show');
        Route::get('/elections/{id}/edit', [ElectionController::class, 'edit'])->name('admin.elections.edit');
        Route::put('/elections/{id}', [ElectionController::class, 'update'])->name('admin.elections.update');
        Route::delete('/elections/{id}', [ElectionController::class, 'destroy'])->name('admin.elections.destroy');
        Route::get('/elections/{id}/candidates', [ElectionController::class, 'showCandidates'])->name('admin.elections.candidates');
        Route::get('/elections/{id}/assign', [ElectionController::class, 'assignCandidatesForm'])->name('admin.elections.assign');
        Route::post('/elections/{id}/assign', [ElectionController::class, 'assignCandidates'])->name('admin.elections.assign.post');
    });

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

