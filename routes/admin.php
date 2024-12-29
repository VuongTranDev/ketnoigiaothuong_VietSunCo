<?php

use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\backend\BackupController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CompaniesController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('news', NewsController::class);
Route::resource('/categories',CategoriesController::class);
// Companies Admin
Route::get('companies', [CompaniesController::class,'index'])->name('companies.index');
Route::get('detailCompany/{id}', [CompaniesController::class,'detailCompany'])->name('companies.detail');

//Backup and restore
Route::get('index', [BackupController::class,'index'])->name('backup.index');
Route::post('backup', [BackupController::class,'backup'])->name('backupDB');
Route::post('backupSchedule', [BackupController::class,'backupSchedule'])->name('backup.schedule');
