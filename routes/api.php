<?php

use App\Http\Controllers\Api\Admin\Category\CategoryController;
use App\Http\Controllers\Api\Admin\CourseControl\AdminCourseRegistration;
use App\Http\Controllers\APi\admin\courseControl\CourseController;
use App\Http\Controllers\Api\admin\EmployeeController;
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
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Api\User\CourseRegister\CourseRegistrationController;
use App\Http\Controllers\AssignmentSolutionController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupTechnicalEmployeeController;
use App\Http\Controllers\PermissionAssignController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
// use App\Http\Controllers\CourseController;
// use App\Http\Controllers\Api\user\UserRegisterController;
use App\Models\Empolyee;
use App\Models\GroupTechnicalEmployee;
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

// Route::get('/user', function () {
//     // return $request->user();
//     return  Student::get();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user/profile',[ProfileController::class, 'profile'])->middleware('auth:sanctum');

// Route::resource('/course',CourseController::class)->only('show','index');

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

// Route::resource('/progress', ProgressController::class)->middleware('auth:sanctum');
// Route::resource('/technicalEmployee', TechnicalEmployeeController::class)->only('index','show');
Route::resource('/region', RegionController::class)->only('index','show');
// Route::post('/registeration/{groupId}',[CourseRegistrationController::class,'store'])->middleware('auth:sanctum');
Route::resource('/assignment',AssignmentSolutionController::class)->middleware('auth:sanctum');
// Route::get('/assignment',[AssignmentSolutionController::class,'index'])->middleware('auth:sanctum');
Route::resource('/registeration',CourseRegistrationController::class)->middleware('auth:sanctum');
Route::resource('/category', CategoryController::class);
Route::resource('/course', CourseController::class);
Route::resource('/region',RegionController::class);
Route::resource('/employee', EmployeeController::class);
Route::resource('/technicalEmployee', TechnicalEmployeeController::class);
Route::resource('/assignment', AssignmentController::class);
Route::resource('/role', RoleController::class);
// Route::resource('/assignPermission', PermissionAssignController::class);
Route::post('/assignPermission', [PermissionAssignController::class, 'store'])->middleware(['is.admin','auth:sanctum'])->name('assignPermission.store');
Route::delete('/assignPermission', [PermissionAssignController::class, 'destroy'])->middleware(['is.admin','auth:sanctum'])->name('assignPermission.deassign');
Route::resource('/permission',permissionController::class);

Route::prefix('/admin')->middleware(['auth:sanctum', 'is.admin'])->group(function () {
    Route::resource('/technicalEmployeeGroups', GroupTechnicalEmployeeController::class);
    // Route::post('/createGroup', [GroupController::class, 'store']);
    Route::resource('/group', GroupController::class);
    Route::resource('/registeration',AdminCourseRegistration::class);
    Route::resource('/session', SessionController::class);
    // Route::post('/createSession', [SessionController::class, 'store']);
    // Route::put('/updateSession/{sessionId}', [SessionController::class, 'update']);
    // Route::delete('/deleteSession/{sessionId}', [SessionController::class, 'destroy']);
    // Route::get('/showSession/{sessionId}', [SessionController::class, 'show']);
    // Route::get('/session', [SessionController::class, 'index']);
    Route::resource('/attendances',AttendancesController::class);


    // Route::get('/getEmployee',function(){
    //     return Empolyee::with('employee')->get();
    // });
});
// Route::resource('roles', RolesController::class);
// Route::resource('permissions', PermissionsController::class);
