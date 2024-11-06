<?php

use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\frontend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('news', NewsController::class);
