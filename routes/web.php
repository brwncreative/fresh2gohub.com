<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\InterrogateUser;
use App\Http\Controllers\AuthController;

Route::get('/', [LandingController::class, 'welcome'])->name('welcome');
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::get('/results', [LandingController::class, 'results'])->name('results');
Route::get('/orders', [LandingController::class, 'orders'])->name('orders');
Route::get('/checkout', [LandingController::class, 'checkout'])->name('checkout');
Route::get('/dashboard/{purpose?}', [LandingController::class, 'dashboard'])->name('dashboard')->middleware(InterrogateUser::class);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
