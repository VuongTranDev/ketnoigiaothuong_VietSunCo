<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\auth\LoginController;

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\CompaniesController as FrontendCompaniesController;
use App\Http\Controllers\frontend\DashboardController;

use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\HomeController;
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

// Route::get('/', [
//     HomeController::class,
//     "index"
// ]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'news']);
Route::get('/news-detail', [NewsController::class, 'newsDetail'])->name('news.detail');

Route::get('/chi-tiet-cong-ty', [FrontendCompaniesController::class, 'companyDetail'])->name('company.detail');


// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::resource('news', NewsController::class);
// });


Route::get('/login/get', [LoginController::class, 'create'])->name('auth.login');
Route::post('/login/post', [LoginController::class, 'store'])->name('auth.post-login');

Route::get('/regis', [RegisterController::class, 'create'])->name('get.register');
Route::post('/register/post', [RegisterController::class, 'store'])->name('auth.register');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/danh-sach-cong-ty', [FrontendCompaniesController::class, 'companyList'])->name('company.list-company');

Route::get('showData', [HomeController::class, 'showData'])->name('news.show');

Route::get('getsession',[LoginController::class,'someFunction']);
Route::get('clearsession',[LoginController::class,'clearSession']);
