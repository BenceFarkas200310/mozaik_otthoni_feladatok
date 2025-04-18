<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\RoundController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/competitions/{id}', [CompetitionController::class, 'show']);

Route::get('/rounds/{roundId}', [RoundController::class, 'showRoundDetails'])->name('round.details');

Route::post('/logout', function () {
    auth()->logout();
    return view('home');
});
