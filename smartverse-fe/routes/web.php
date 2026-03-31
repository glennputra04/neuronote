<?php

use App\Http\Controllers\SummarizerController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/summary', [SummarizerController::class, 'summary']);

Route::post('/summarize', [SummarizerController::class, 'index']);

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
