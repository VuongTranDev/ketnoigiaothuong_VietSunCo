<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Models\News;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getInfo']);

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'slug not exist!'
    ], 404);
});

// Route::prefix('companies')->group(function () {
//     Route::apiResource('/', CompaniesController::class);
//     Route::get('/', [CompaniesController::class, 'index']);
//     Route::get('/{id}', [CompaniesController::class, 'show']);
//     Route::post('/store', [CompaniesController::class, 'store']);
// });

Route::prefix('companies')->group(function () {
    Route::apiResource('/', CompaniesController::class);
    Route::get('/{id}', [CompaniesController::class, 'show']);
});

Route::prefix('news')->group(function () {
    Route::apiResource('/', NewsController::class);
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/{id}', [NewsController::class, 'show']);
});

