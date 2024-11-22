
<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginGoogleController;



Route::get('/login/get', [LoginController::class, 'create'])->name('auth.login');
Route::post('/login/post', [LoginController::class, 'store'])->name('auth.post-login');

Route::get('/regis', [RegisterController::class, 'create'])->name('get.register');
Route::post('/register/post', [RegisterController::class, 'store'])->name('auth.register');

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

// login google


Route::get('login/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback'])->name('google.callback');
