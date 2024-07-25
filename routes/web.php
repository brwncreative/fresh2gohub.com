<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'default'])->name('/');

Route::group(['prefix' => 'mailing/'], function () {
    Route::get('/welcome/{email}', [MainController::class, 'welcome'])->name('welcome');
});
