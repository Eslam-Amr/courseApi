<?php

use App\Http\Controllers\Api\Admin\Category\CategoryController;
use App\Http\Controllers\APi\admin\courseControl\CourseController;
use App\Http\Controllers\Api\admin\Employee\EmployeeController;
use App\Http\Controllers\APi\Admin\Group\GroupController;
use App\Http\Controllers\APi\Admin\Group\GroupTechnicalEmployeeController;
use App\Http\Controllers\APi\Admin\PermissionRole\PermissionAssignController;
use App\Http\Controllers\APi\Admin\PermissionRole\RoleController;
use App\Http\Controllers\Api\Admin\Region\RegionController;
use App\Http\Controllers\APi\Admin\Session\SessionController;
use App\Http\Controllers\Api\Admin\TechnicalEmployee\TechnicalEmployeeController;
use App\Http\Controllers\Api\auth\EditProfileController;
use App\Http\Controllers\Api\auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\auth\ProfileController;
use App\Http\Controllers\Api\auth\UserRegisterController;
use App\Http\Controllers\APi\TechnicalEmployee\Assignment\AssignmentController;
use App\Http\Controllers\APi\TechnicalEmployee\Assignment\AssignmentSolutionController;
use App\Http\Controllers\APi\TechnicalEmployee\Attendances\AttendancesController;
use App\Http\Controllers\Api\User\Rate\RateController;
use App\Http\Controllers\Api\User\Wishlist\WishlistController;
use App\Http\Controllers\Api\User\CourseRegister\CourseRegistrationController;
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
Route::get('/user/profile',[ProfileController::class, 'profile'])->middleware('auth:sanctum');
Route::post('/user/register',[UserRegisterController::class,'createUser']);
Route::post('/user/wishlist/{id}',[WishlistController::class,'index'])->middleware('auth:sanctum');
Route::get('/user/wishlist',[WishlistController::class,'getWishlist'])->middleware('auth:sanctum');
Route::post('/user/add/wishlist/{id}',[WishlistController::class,'addToWishlist'])->middleware('auth:sanctum');
Route::delete('/user/delete/wishlist/{id}',[WishlistController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/user/rate/{id}',[RateController::class,'create'])->middleware('auth:sanctum');
Route::delete('/user/rate/{id}',[RateController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LogoutController::class,'logout']);
Route::put('/editProfile',[EditProfileController::class,'edit'])->middleware('auth:sanctum');
Route::resource('/region', RegionController::class)->only('index','show');
Route::resource('/assignment',AssignmentSolutionController::class)->middleware('auth:sanctum');
Route::resource('/registeration',CourseRegistrationController::class)->middleware('auth:sanctum');
Route::resource('/category', CategoryController::class);
Route::resource('/course', CourseController::class);
Route::resource('/region',RegionController::class);
Route::resource('/employee', EmployeeController::class);
Route::resource('/technicalEmployee', TechnicalEmployeeController::class);
Route::resource('/assignment', AssignmentController::class);
Route::resource('/role', RoleController::class)->middleware(["is.admin","auth:sanctum"]);
Route::post('/assignPermission', [PermissionAssignController::class, 'store'])->middleware(['is.admin','auth:sanctum'])->name('assignPermission.store');
Route::delete('/assignPermission', [PermissionAssignController::class, 'destroy'])->middleware(['is.admin','auth:sanctum'])->name('assignPermission.deassign');
Route::resource('/attendances',AttendancesController::class);
Route::resource('/group', GroupController::class);
Route::resource('/technicalEmployeeGroups', GroupTechnicalEmployeeController::class);
Route::resource('/session', SessionController::class);
