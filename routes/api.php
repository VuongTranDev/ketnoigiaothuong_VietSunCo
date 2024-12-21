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
use App\Http\Controllers\api\CompanyImageController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\RatingController;
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



Route::apiResource('comments',CommentAPIController::class);

Route::post('stattisticMB', ReportAPIController::class)->name('statisticMember') ;


Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'slug not exist!'
    ], 404);
});

Route::apiResource('/rating', RatingController::class);
Route::apiResource('/company', CompaniesController::class);
Route::apiResource('/new', NewsController::class)->names(['index' => 'api.new']);
Route::get('new/slug/{slug}', [NewsController::class, 'showBySlug'])->name('api.new.showBySlug');
Route::apiResource('/category', CategoriesController::class);
Route::apiResource('/company-category', CompanyCategoryController::class);
Route::apiResource('/address', AddressController::class);

Route::get('/getAllCategory',[CategoriesController::class,'getAllCategory'])->name('getAllCategory');

Route::get('/getAllCompany/{slug}',[CompaniesController::class,'findCompanyByName'])->name('findCompanyByName');
Route::get('/getCompanyByCate/{id}',[CompaniesController::class,'findCompanyByCateId'])->name('findCompanyByCateId');
// Route::prefix('companies')->group(function () {
//     Route::apiResource('/', CompaniesController::class);
//     Route::get('/', [CompaniesController::class, 'index']);
//     Route::get('/{id}', [CompaniesController::class, 'show']);
//     Route::post('/store', [CompaniesController::class, 'store']);
// });

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('createCompany', [CompaniesController::class, 'createCompany'])->name('createCompany');
Route::post('createCompanyCategory', [CompanyCategoryController::class, 'createCompanyCategory'])->name('createCompanyCategory');
Route::post('createNewCompanyImage',[CompanyImageController::class,'createNew'])->name('createNew');
Route::get('checkCompany/{id}',[CompaniesController::class,'checkCompanyByUserId'])->name('checkCompany');

Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'getInfo'])->name('user');
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->post('changeStatus/{id}', [AuthController::class, 'changeStatusUser']);

//Route::middleware('auth:sanctum')->get('/news/statistics', [NewsController::class, 'statistics'])->name('news.statistics');
// Message
Route::middleware('auth:sanctum')->post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::middleware('auth:sanctum')->get('/messages/{userId}', [MessageController::class, 'getMessages'])->name('messages.get');
Route::middleware('auth:sanctum')->post('/messages/{messageId}/read', [MessageController::class, 'markAsRead'])->name('messages.read');

//

