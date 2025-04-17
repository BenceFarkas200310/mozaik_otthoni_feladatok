<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/competitions/{id}', [CompetitionController::class, 'show']);

Route::post('/logout', function () {
    auth()->logout();
    return view('home');
});
