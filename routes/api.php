<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CompaniesController;
use App\Http\Controllers\api\MessageController;

use App\Models\News;
use Illuminate\Support\Facades\Route;




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

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'getInfo'])->name('user');
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->post('changeStatus/{id}', [AuthController::class, 'changeStatusUser']);

//Route::middleware('auth:sanctum')->get('/news/statistics', [NewsController::class, 'statistics'])->name('news.statistics');
// Message
Route::middleware('auth:sanctum')->post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::middleware('auth:sanctum')->get('/messages/{userId}', [MessageController::class, 'getMessages'])->name('messages.get');
Route::middleware('auth:sanctum')->post('/messages/{messageId}/read', [MessageController::class, 'markAsRead'])->name('messages.read');



