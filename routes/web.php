<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\InterrogateUser;
use App\Http\Controllers\AuthController;
use App\Models\Order;

Route::get('/', [LandingController::class, 'welcome'])->name('welcome');
Route::get('/results', [LandingController::class, 'results'])->name('results');
Route::get('/orders', [LandingController::class, 'orders'])->name('orders');
Route::get('/checkout', [LandingController::class, 'checkout'])->name('checkout');
Route::get('/dashboard/{purpose?}', [LandingController::class, 'dashboard'])->name('dashboard')->middleware(InterrogateUser::class);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/order', function () {
    return view('mail.order')->with('order', Order::find(1));
});
Route::get('/welcome-mailing', function () {
    return view('mail.welcome-mailing')->with('recipient', 'fresh2gohub@gmail.com');
});
