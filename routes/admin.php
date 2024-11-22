<?php

use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CompaniesController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('news', NewsController::class);

// Companies Admin
Route::get('companies', [CompaniesController::class,'index'])->name('companies.index');
