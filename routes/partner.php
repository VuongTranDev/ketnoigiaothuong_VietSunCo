<?php

use App\Http\Controllers\backend\CompaniesController;
use App\Http\Controllers\CommentController;
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
Route::get('/company', [CompaniesController::class, 'index'])->name('company.index');
Route::get('/company/category', [CompaniesController::class, 'companyCategory'])->name('company.category');
Route::get('/company/images', [CompaniesController::class, 'companyImages'])->name('company.images');
Route::post('/company/deleteImages', [CompaniesController::class, 'destroyCompanyImage'])->name('company.deleteImages');
Route::post('/company/createImages', [CompaniesController::class, 'createCompanyImages'])->name('company.createImages');
Route::post('/company/newCategory', [CompaniesController::class, 'storeCategoryCompany'])->name('company.category.store');
Route::post('/company/deleteCategory', [CompaniesController::class, 'deleteCategoryCompany'])->name('company.category.delete');
Route::resource('news', NewsController::class);
Route::resource('address', AddressController::class);
Route::post('news/change-status', [NewsController::class, 'changeStatus'])->name('news.change-status');
Route::get('/news/comment/{id}', [CommentController::class, 'index'])->name('comment.list.index');
