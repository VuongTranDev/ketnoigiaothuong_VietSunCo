<?php

use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CompaniesController;
use App\Http\Controllers\backend\ContactsController;
use App\Http\Controllers\backend\FooterGridInfoController;
use App\Http\Controllers\backend\FooterGridThreeController;
use App\Http\Controllers\backend\FooterGridTwoController;
use App\Http\Controllers\backend\FooterSocialController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('news', NewsController::class);
Route::resource('/categories',CategoriesController::class);
// Companies Admin
Route::get('companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('detailCompany/{id}', [CompaniesController::class,'detailCompany'])->name('companies.detail');

// Footer
Route::resource('footer-grid-info', FooterGridInfoController::class);

Route::resource('footer-grid-two', FooterGridTwoController::class);
Route::post('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::post('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');

Route::resource('footer-grid-three', FooterGridThreeController::class);
Route::post('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::post('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');

Route::resource('footer-socials', FooterSocialController::class);
Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');

Route::resource('send-contact', ContactsController::class);
Route::post('send-contact/send-bulk-email', [ContactsController::class, 'sendBulkEmail'])->name('send-contact.send-bulk-email');
