<?php

use App\Http\Controllers\SummarizerController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WelcomeController::class, 'index']);

Route::get('/summary',[SummarizerController::class, 'summary']);

Route::post('/summarize',[SummarizerController::class, 'index']);

