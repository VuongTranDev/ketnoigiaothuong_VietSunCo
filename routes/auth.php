<?php


use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\frontend\CompaniesController;
use Illuminate\Support\Facades\Route;


Route::get('/login/get', [LoginController::class, 'create'])->name('auth.login');
Route::post('/login/post', [LoginController::class, 'store'])->name('auth.post-login');

Route::get('/regis', [RegisterController::class, 'create'])->name('get.register');
Route::post('/register/post', [RegisterController::class, 'store'])->name('auth.register');

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
