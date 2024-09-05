<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'welcome'])->name('welcome');
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::get('/results', [LandingController::class, 'results'])->name('results');
