<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\AdminMiddleware;

Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   
        Route::get('/candidates', [CandidateController::class, 'showCandidate'])->middleware(AdminMiddleware::class);
        Route::get('/users', [UserController::class, 'showUser'])->middleware(AdminMiddleware::class);
        Route::post('/addcandidate', [CandidateController::class, 'addCandidate'])->middleware(AdminMiddleware::class);
        Route::put('/updatecandidate/{id}', [CandidateController::class, 'updateCandidate'])->middleware(AdminMiddleware::class);
        Route::delete('/deletecandidate/{id}', [CandidateController::class, 'deleteCandidate'])->middleware(AdminMiddleware::class);
        Route::get('/getvotes', [VoteController::class, 'getVoteCount']);
        Route::post('/votecandidate/{id}', [VoteController::class, 'voteCandidate']);

});

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
