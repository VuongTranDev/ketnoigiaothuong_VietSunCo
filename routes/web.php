<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\CompaniesController as FrontendCompaniesController;
use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [
    HomeController::class,
    "index"
]);

Route::get('/news', [NewsController::class, 'news']);

Route::get('/showData', [HomeController::class, 'showData']);

// Route::prefix('companies')->group(function () {
//     Route::apiResource('/', CompaniesController::class);
//     Route::get('/{id}', [CompaniesController::class, 'show']);
// });


Route::get('/company-detail', [FrontendCompaniesController::class, 'companyDetail'])->name('company.detail');

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [BackendHomeController::class, 'index'])->name('dashboard');
    
});
