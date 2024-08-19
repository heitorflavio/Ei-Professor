<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteLikeController;
use App\Http\Controllers\VoteUnlikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Questions
    Route::resource('question', QuestionController::class);
    // Votes
    Route::post('/vote/like/{question}', VoteLikeController::class)->name('vote.like');
    Route::post('/vote/unlike/{question}', VoteUnlikeController::class)->name('vote.unlike');
});

require __DIR__.'/auth.php';
