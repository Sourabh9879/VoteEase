<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\AdminMiddleware;

// Authentication routes
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Public API routes
Route::get('/getvotes', [VoteController::class, 'getVoteCount']);

// Protected API routes
Route::middleware('auth')->group(function () {
    // User routes
    Route::get('/candidates', [CandidateController::class, 'showCandidate']);
    Route::post('/votecandidate/{id}', [VoteController::class, 'voteCandidate']);
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'showUser']);
        Route::post('/addcandidate', [CandidateController::class, 'addCandidate']);
        Route::put('/updatecandidate/{id}', [CandidateController::class, 'updateCandidate']);
        Route::delete('/deletecandidate/{id}', [CandidateController::class, 'deleteCandidate']);
    });
});
