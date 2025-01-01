<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\auth\LoginController;

use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\backend\CompaniesController as BackendCompaniesController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\CommentsController;
use App\Http\Controllers\frontend\CompaniesController as FrontendCompaniesController;
use App\Http\Controllers\frontend\DashboardController;

use App\Http\Controllers\frontend\NewsController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\MessageController;
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
Route::put('updateCompanyFromView', [BackendCompaniesController::class, 'updateCompany'])->name('updateCompanyFromView');
Route::get('findCompaniesByCate/{cateId}', [FrontendCompaniesController::class, 'findCompanyByCate'])->name('findCompanyByCate');
Route::get('checkStatusCompany', [FrontendCompaniesController::class, 'checkCompanyStatus'])->name('checkStatusCompany');


require __DIR__ . '/auth.php';


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tin-tuc', [NewsController::class, 'news'])->name('news');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'newsDetail'])->name('news.detail');

Route::get('/chi-tiet-cong-ty/{slug}', [FrontendCompaniesController::class, 'companyDetail'])->name('company.detail');



Route::get('/login/get', [LoginController::class, 'create'])->name('auth.login');
Route::post('/login/post', [LoginController::class, 'store'])->name('auth.post-login');


Route::get('/regis', [RegisterController::class, 'create'])->name('get.register');
Route::post('/register/post', [RegisterController::class, 'store'])->name('auth.register');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');


Route::get('/danh-sach-cong-ty', [FrontendCompaniesController::class, 'companyList'])->name('company.list-company');

Route::get('getsession', [LoginController::class, 'someFunction']);

Route::get('clearsession', [LoginController::class, 'clearSession']);


Route::post('/postComment', [CommentsController::class, 'createComment'])->name('postComment');
Broadcast::routes();

// message
Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('message', [MessageController::class, 'index'])->name('message.index');
    Route::get('message/getmessage', [MessageController::class, 'getMessages'])->name('message.getMessages');
    Route::post('message/sendmessage', [MessageController::class, 'sendMessage'])->name('message.send-message');
    Route::post('message/read', [MessageController::class, 'maskAsRead'])->name('message.read');
    Route::get('getCompany', [MessageController::class, 'fillInformation'])->name('message.fillInformation');
    Route::post('createTransaction', [MessageController::class, 'createTransaction'])->name('message.createTransaction');
    Route::get('getTransactions', [MessageController::class, 'getTransaction'])->name('message.getTransaction');
});

Route::post('/postComment',[CommentsController::class,'createComment'])->name('postComment');

Route::get('/tin-tuc/tim-kiem/search',[NewsController::class, 'search'])->name('news.search');

Route::post('/send-contact', [HomeController::class, 'sendContact'])->name('send.contact');

