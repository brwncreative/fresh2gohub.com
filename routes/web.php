<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Livewire\Login;

Route::get('/', [MainController::class, 'default'])->name('/');
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::group(['prefix' => 'mailing/'], function () {
    Route::get('/welcome/{email}', [MainController::class, 'welcome'])->name('welcome');
});

Route::group(['prefix' => 'dashboard/'], function () {
    Route::get('/', function(){ return view('dashboard');})->name('dashboard');
    Route::get('/products', function(){ return view('dashboard');})->name('dashboard-products');
    Route::get('/mailing-list', function(){ return view('dashboard');})->name('dashboard-mailing-list');
    Route::get('/users', function(){ return view('dashboard');})->name('dashboard-users');
});
