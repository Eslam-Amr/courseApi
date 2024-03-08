<?php

use App\Http\Controllers\Api\Admin\Category\CategoryController;
use App\Http\Controllers\APi\admin\courseControl\CourseController;
use App\Http\Controllers\Api\admin\CreateEmployeeController;
use App\Http\Controllers\Api\Admin\Region\RegionController;
use App\Http\Controllers\Api\Admin\TechnicalEmployee\TechnicalEmployeeController;
// use App\Http\Controllers\Api\admin\LoginController as AdminLoginController;
// use App\Http\Controllers\Api\employee\LoginController as EmployeeLoginController;
// use App\Http\Controllers\Api\technicalEmployee\LoginController as TechnicalEmployeeLoginController;
// use App\Http\Controllers\Api\techniaclEmployee\LoginController;
// use App\Http\Controllers\Api\user\LoginController as UserLoginController;
// \App\Http\Controllers\Api\auth\

use App\Http\Controllers\Api\auth\EditProfileController;
use App\Http\Controllers\Api\auth\LoginController;
// use App\Http\Controllers\Api\auth\LoginController as UserLoginController;
use App\Http\Controllers\Api\auth\ProfileController;
use App\Http\Controllers\Api\auth\UserRegisterController;
use App\Http\Controllers\Api\User\Rate\RateController;
use App\Http\Controllers\Api\User\Wishlist\WishlistController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SessionController;
// use App\Http\Controllers\CourseController;
// use App\Http\Controllers\Api\user\UserRegisterController;
use App\Models\Empolyee;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/user', function () {
    // return $request->user();
    return  Student::get();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user/profile',[ProfileController::class, 'profile'])->middleware('auth:sanctum');

Route::get('/course/{id}',[CourseController::class,'getSingleCourse']);

Route::post('/user/register',[UserRegisterController::class,'createUser']);
Route::post('/user/wishlist/{id}',[WishlistController::class,'index'])->middleware('auth:sanctum');
Route::get('/user/wishlist',[WishlistController::class,'getWishlist'])->middleware('auth:sanctum');
Route::post('/user/add/wishlist/{id}',[WishlistController::class,'addToWishlist'])->middleware('auth:sanctum');
Route::delete('/user/delete/wishlist/{id}',[WishlistController::class,'destroy'])->middleware('auth:sanctum');
// Route::post('/user/wishlist',[WishlistController::class,'index']);
// Route::post('/user/wishlist',[WishlistController::class,'index']);


Route::post('/user/rate/{id}',[RateController::class,'create'])->middleware('auth:sanctum');
Route::delete('/user/rate/{id}',[RateController::class,'destroy'])->middleware('auth:sanctum');
// Route::post('/user/rate/{id}',[RateController::class,'create'])->middleware('auth:sanctum');




Route::post('/login',[LoginController::class,'login']);
Route::put('/editProfile',[EditProfileController::class,'edit'])->middleware('auth:sanctum');

Route::prefix('/admin')->middleware(['auth:sanctum', 'is.admin'])->group(function () {
Route::post('/createGroup/{courseId}', [GroupController::class, 'store']);
    Route::post('/createEmployee', [CreateEmployeeController::class, 'create']);
    Route::post('/createTechnicalEmployee', [TechnicalEmployeeController::class, 'create']);
    Route::post('/createSession', [SessionController::class, 'store']);
    Route::post('/createRegion', [RegionController::class, 'create']);
    Route::post('/createCourse', [CourseController::class, 'create']);
    Route::post('/createCategory', [CategoryController::class, 'create']);
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'destroy']);
    Route::put('/editCategory/{id}', [CategoryController::class, 'edit']);
    Route::get('/getEmployee',function(){
        return Empolyee::with('employee')->get();
    });
});
