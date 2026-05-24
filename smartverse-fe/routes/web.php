<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SummarizerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/summary', [SummarizerController::class, 'summary'])->middleware('auth');
Route::get('/summary/{id}', [SummarizerController::class, 'show'])->middleware('auth');
Route::delete('/summary/{id}', [SummarizerController::class, 'destroy'])->middleware('auth');

Route::post('/summarize', [SummarizerController::class, 'index'])->middleware('auth');
Route::get('/history', [SummarizerController::class, 'history'])->middleware('auth')->name('history');

Route::get('/quiz', [QuizController::class, 'quiz'])->middleware('auth');
Route::get('/quiz-result', [QuizController::class, 'result'])->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
