<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElectionController;

// Public Routes
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


        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');

        Route::get('/user/results', [VoteController::class, 'getVoteCount'])->name('user.results');

        Route::get('/user/candidates', [CandidateController::class, 'showCandidate'])->name('user.candidates');
        Route::post('/user/vote/{id}', [VoteController::class, 'voteCandidate'])->name('user.vote.candidate');
        
        // User Election Routes
        Route::get('/user/elections', [ElectionController::class, 'userViewElections'])->name('user.elections');
        Route::get('/user/elections/{election}', [ElectionController::class, 'userViewElection'])->name('user.elections.view');

        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [UserController::class, 'showUser'])->name('admin.users');
        Route::get('/admin/results', [VoteController::class, 'getVoteCount'])->name('admin.results');
        Route::get('/admin/candidates', [CandidateController::class, 'manageCandidate'])->name('admin.candidates');
        Route::post('/admin/candidates', [CandidateController::class, 'addCandidate'])->name('admin.candidates.add');
        Route::get('/admin/candidates/{id}/edit', [CandidateController::class, 'editCandidate'])->name('admin.candidates.edit');
        Route::put('/admin/candidates/{id}', [CandidateController::class, 'updateCandidate'])->name('admin.candidates.update');
        Route::delete('/admin/candidates/{id}', [CandidateController::class, 'deleteCandidate'])->name('admin.candidates.delete');
        
        // Admin Election Routes
        Route::get('/admin/elections', [ElectionController::class, 'index'])->name('admin.elections.index');
        Route::get('/admin/elections/create', [ElectionController::class, 'create'])->name('admin.elections.create');
        Route::post('/admin/elections', [ElectionController::class, 'store'])->name('admin.elections.store');
        Route::get('/admin/elections/{election}', [ElectionController::class, 'show'])->name('admin.elections.show');
        Route::get('/admin/elections/{election}/edit', [ElectionController::class, 'edit'])->name('admin.elections.edit');
        Route::put('/admin/elections/{election}', [ElectionController::class, 'update'])->name('admin.elections.update');
        Route::delete('/admin/elections/{election}', [ElectionController::class, 'destroy'])->name('admin.elections.destroy');
        Route::get('/admin/elections/{election}/candidates', [ElectionController::class, 'showCandidates'])->name('admin.elections.candidates');
        Route::get('/admin/elections/{election}/assign', [ElectionController::class, 'assignCandidatesForm'])->name('admin.elections.assign');
        Route::post('/admin/elections/{election}/assign', [ElectionController::class, 'assignCandidates'])->name('admin.elections.assign.post');


    // Logout Route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

