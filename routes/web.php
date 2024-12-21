<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\auth\LoginController;

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\CompaniesController as FrontendCompaniesController;
use App\Http\Controllers\frontend\DashboardController;

use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\RatingController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
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

Route::post('createRating', [RatingController::class, 'createRating'])->name('createRating');
Route::post('insertCompany', [FrontendCompaniesController::class, 'createCompany'])->name('insertCompany');
Route::post('findCompanies', [FrontendCompaniesController::class, 'findCompany'])->name('findCompany');
Route::get('findCompaniesByCate/{cateId}', [FrontendCompaniesController::class, 'findCompanyByCate'])->name('findCompanyByCate');



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tin-tuc', [NewsController::class, 'news'])->name('news');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'newsDetail'])->name('news.detail');

Route::get('/chi-tiet-cong-ty', [FrontendCompaniesController::class, 'companyDetail'])->name('company.detail');

Route::get('/danh-sach-cong-ty', [FrontendCompaniesController::class, 'companyList'])->name('company.list-company');

Route::get('getsession',[LoginController::class,'someFunction']);

Route::get('clearsession',[LoginController::class,'clearSession']);




