<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;

Route::get('/', [PollController::class, 'index'])->name('home');
Route::resource('polls', PollController::class);
Route::post('polls/{poll}/vote', [VoteController::class, 'store']) ->name('polls.vote');
