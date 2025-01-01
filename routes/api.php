<?php


use App\Http\Controllers\api\CommentAPIController;
use App\Http\Controllers\api\ReportAPIController;
use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\AdminApiController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\CompaniesController;
use App\Http\Controllers\api\CompanyCategoryController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\frontend\DashboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BackupController;
use App\Http\Controllers\api\CompanyImageController;
use App\Http\Controllers\api\ContactsApiController;
use App\Http\Controllers\api\GoogleController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::apiResource('comments', CommentAPIController::class);

Route::post('stattisticMB', ReportAPIController::class)->name('statisticMember');


// Route::fallback(function () {
//     return response()->json([
//         'status' => 'error',
//         'message' => 'Lỗi api'
//     ], 404);
// });


Route::apiResource('/rating', RatingController::class);



Route::post('/report/statisticMember', [ReportAPIController::class,'statisticMember']) ;
Route::get('report/countUser',[ReportAPIController::class,'countUser']);
Route::post('/report/statisticNews', [ReportAPIController::class,'statisticNews']) ;
Route::get('/report/showNewsHot', [ReportAPIController::class,'showNewsHot']) ;
Route::get('/report/companiesHot', [ReportAPIController::class,'companiesHot']) ;
Route::get('/report/countTransactions/{user_id}', [ReportAPIController::class,'countTransactions']) ;
Route::get('/report/countCompaniesConnect/{user_id}', [ReportAPIController::class,'countCompaniesConnect']) ;
Route::get('/report/countCategoriesOfCompany/{user_id}', [ReportAPIController::class,'countCategoriesOfCompany']) ;
Route::get('/report/statisticActivity/{user_id}', [ReportAPIController::class,'statisticActivity']) ;



Route::apiResource('/company', CompaniesController::class);
Route::put('company/status/{id}',[CompaniesController::class,'changeStatus'])->name('company.changeStatus');
Route::get('company/slug/{slug}', [CompaniesController::class, 'showBySlug'])->name('company.showBySlug');
Route::get('company/detail/{id}', [CompaniesController::class, 'showById'])->name('company.showDetailById');
Route::get('company/detail/{slug}', [CompaniesController::class, 'showDetailCompany'])->name('company.showDetailCompany');

Route::apiResource('/new', NewsController::class)->names(['index' => 'api.new']);
Route::get('new/slug/{slug}', [NewsController::class, 'showBySlug'])->name('api.new.showBySlug');
Route::get('new/comment/{slug}',[NewsController::class,'showAllComments'])->name('api.news.showAllComment');
Route::get('new/show5NewOfUser/{user_id}',[NewsController::class,'show5NewOfUser']);
Route::get('new/countNewsOfUser/{user_id}',[NewsController::class,'countNewsOfUser']);
Route::put('new/status/{id}',[NewsController::class,'changeStatus'])->name('news.changeStatus');
Route::get('new/user/{user_id}',[NewsController::class,'showNewsByUserId'])->name('api.news.showNewsByUserId');
Route::get('new/search/search_query={search_query}', [NewsController::class, 'searchNews'])->name('api.news.search');
Route::get('new/showAllCommentInNewsById/{id}', [NewsController::class, 'showAllCommentInNewsById'])->name('api.new.showAllCommentInNewsById');



Route::apiResource('/categories', CategoriesController::class)->names(['index' => 'api.categories']);
Route::get('category/company/{id}', [CompanyCategoryController::class, 'showCategoryByCompanyId'])->name('category.showCategoryByIdCompany');

Route::apiResource('/company-category', CompanyCategoryController::class);

Route::apiResource('address', AddressController::class);
Route::apiResource('/comments',CommentAPIController::class);
Route::get('address/company/{id}', [AddressController::class, 'showAddressByIdCompany'])->name('address.showAddressByIdCompany');

Route::get('ratings/company/{id}', [RatingController::class, 'showRatingByCompanyId'])->name('rating.showRatingByCompanyId');


Route::get('/getAllCategory',[CategoriesController::class,'getAllCategory'])->name('getAllCategory');

Route::get('/getAllCompany/{slug}',[CompaniesController::class,'findCompanyByName'])->name('findCompanyByName');
Route::get('/getCompanyByCate/{id}',[CompaniesController::class,'findCompanyByCateId'])->name('findCompanyByCateId');
Route::get('/checkRating/{userid}/{company_id}',[RatingController::class,'checkRating'])->name('checkRating');
Route::get('/avgPointCompany/{company_id}',[RatingController::class,'avgPointCompany'])->name('avgPointCompany');
Route::get('/countAllRating/{company_id}',[RatingController::class,'countAllRating'])->name('countAllRating');
Route::get('/countStarRating/{company_id}',[RatingController::class,'countStarRating'])->name('countStarRating');
// Route::prefix('companies')->group(function () {
//     Route::apiResource('/', CompaniesController::class);
//     Route::get('/', [CompaniesController::class, 'index']);
//     Route::get('/{id}', [CompaniesController::class, 'show']);
//     Route::post('/store', [CompaniesController::class, 'store']);
// });

Route::get('auth/callback/google', [AuthController::class, 'handleGoogleCallback']);



// Login bình thường
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('createCompany', [CompaniesController::class, 'createCompany'])->name('createCompany');
Route::post('createCompanyCategory', [CompanyCategoryController::class, 'createCompanyCategory'])->name('createCompanyCategory');
Route::post('deleteCompanyCategory', [CompanyCategoryController::class, 'deleteCompanyCategory'])->name('deleteCompanyCategory');
Route::post('createNewCompanyImage',[CompanyImageController::class,'createNew'])->name('createNew');
Route::post('destroyCompanyImage',[CompanyImageController::class,'destroyCompanyImage'])->name('destroyCompanyImage');
Route::get('checkCompany/{id}',[CompaniesController::class,'checkCompanyByUserId'])->name('checkCompany');
Route::get('checkCompanyWithStatus/{id}',[CompaniesController::class,'checkCompanyByUserIdWithStatus'])->name('checkCompanyWithStatus');
Route::get('checkCompanyStatus/{id}',[CompaniesController::class,'checkCompanyStatus'])->name('checkCompanyStatus');
Route::put('updatePointCompany/{company_id}/{point}',[CompaniesController::class,'updatePointCompany'])->name('updatePointCompany');
Route::put('updateCompany',[CompaniesController::class,'updateCompany'])->name('updateCompany');


Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'getInfo']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->post('changeStatus/{id}', [AuthController::class, 'changeStatusUser']);

//Route::middleware('auth:sanctum')->get('/news/statistics', [NewsController::class, 'statistics'])->name('news.statistics');
// Message
Route::middleware('auth:sanctum')->post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::middleware('auth:sanctum')->get('/messages/{userId}', [MessageController::class, 'getMessages'])->name('messages.get');
Route::middleware('auth:sanctum')->post('/messages/{messageId}/read', [MessageController::class, 'markAsRead'])->name('messages.read');

// Backup and restore
Route::post('/backupDB', [BackupController::class, 'backup'])->name('backup');
Route::post('/backup', [BackupController::class, 'backupSchedule'])->name('post.backup');
Route::get('/backup', [BackupController::class, 'showListBackup'])->name('get.backup');
Route::delete('/backup/{id}', [BackupController::class, 'removeschedule'])->name('delete.schedule');
Route::delete('/backup', [BackupController::class, 'removeAllSchedule'])->name('delete.Allschedule');

Route::post('/restore', [BackupController::class, 'restore'])->name('post.restore');

Route::middleware('web')->get('/get-google-sign-in-url', [GoogleController::class, 'getGoogleSignInUrl'])->name('loginGoogle');
Route::middleware('web')->get('/auth/google/callback', [GoogleController::class, 'loginCallback']);
Route::middleware('auth:sanctum')->post('/messages/{messageId}/read', [MessageController::class, 'markAllAsRead'])->name('messages.read');
Route::middleware('auth:sanctum')->get('/messages/user/{id}', [MessageController::class, 'getUser'])->name('messages.getUser');
Route::middleware('auth:sanctum')->get('/messages/{receiverId}/exist', [MessageController::class, 'existMessage']);
Route::middleware('auth:sanctum')->get('/getCompanyByUser', [MessageController::class, 'getCompanyByUser'])->name('messages.index');
Route::middleware('auth:sanctum')->post('/createTransaction', [MessageController::class, 'createTransaction'])->name('messages.createTransaction');
Route::middleware('auth:sanctum')->get('/getTransaction/{receiverId}', [MessageController::class, 'getTransaction'])->name('messages.getTransaction');

Route::middleware('web')->get('/get-google-sign-in-url', [GoogleController::class, 'getGoogleSignInUrl'])->name('loginGoogle');
Route::middleware('web')->get('/auth/google/callback', [GoogleController::class, 'loginCallback']);


Route::apiResource('send-contact', ContactsApiController::class)->names(['index' => 'api.send-contact']);
Route::post('new/change-status', [NewsController::class, 'changeStatus'])->name('api.news.changeStatus');
Route::get('new/company/{id}',[NewsController::class,'showNewsByCompanyId'])->name('api.news.showNewsByCompanyId');
