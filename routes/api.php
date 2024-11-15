<?php


use App\Http\Controllers\api\CommentAPIController;
use App\Http\Controllers\api\ReportAPIController;
use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\CompaniesController;
use App\Http\Controllers\api\CompanyCategoryController;
use App\Http\Controllers\api\NewsController;
use Illuminate\Http\Request;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\GoogleController;
use App\Http\Controllers\api\MessageController;

use App\Models\News;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('stattisticMB', ReportAPIController::class)->name('statisticMember') ;


Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Lỗi api'
    ], 404);
});


Route::apiResource('/company', CompaniesController::class);
Route::get('company/slug/{slug}', [CompaniesController::class, 'showBySlug'])->name('company.showBySlug');
Route::get('company/detail/{slug}', [CompaniesController::class, 'showDetailCompany'])->name('company.showDetailCompany');

Route::apiResource('/new', NewsController::class)->names(['index' => 'api.new']);
Route::get('new/slug/{slug}', [NewsController::class, 'showBySlug'])->name('api.new.showBySlug');
Route::get('new/comment/{slug}',[NewsController::class,'showAllComments'])->name('api.news.showAllComment');
Route::get('new/newOfUser/{user_id}',[NewsController::class,'show5NewOfUser']);
Route::apiResource('/category', CategoriesController::class);
Route::get('category/company/{id}', [CompanyCategoryController::class, 'showCategoryByCompanyId'])->name('category.showCategoryByIdCompany');

Route::apiResource('/company-category', CompanyCategoryController::class);

Route::apiResource('/address', AddressController::class);
Route::apiResource('/comments',CommentAPIController::class);
Route::get('address/company/{id}', [AddressController::class, 'showAddressByIdCompany'])->name('address.showAddressByIdCompany');


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

//


Route::middleware('web')->get('/get-google-sign-in-url', [GoogleController::class, 'getGoogleSignInUrl'])->name('loginGoogle');
Route::middleware('web')->get('/google-callback', [GoogleController::class, 'loginCallback']);


