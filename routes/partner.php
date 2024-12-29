<?php


use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\partner\NewsController;
use App\Http\Controllers\partner\AddressController;
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

Route::get('/dashboard', [DashboardController::class, 'partner'])->name('dashboard');
Route::get('/news/hotnews', [NewsController::class, 'hotNews'])->name('news.hotnews');
Route::resource('news', NewsController::class);
Route::resource('address', AddressController::class);
Route::post('news/change-status', [NewsController::class, 'changeStatus'])->name('news.change-status');
