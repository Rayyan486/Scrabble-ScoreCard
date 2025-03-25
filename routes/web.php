<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GameController;

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
Route::resource('members', MemberController::class);
Route::resource('games', GameController::class);
