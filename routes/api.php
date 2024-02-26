<?php

use App\Http\Controllers\APi\admin\courseControl\AddCourseController;
use App\Http\Controllers\Api\admin\CreateEmployeeController;
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
use App\Http\Controllers\Api\user\RegisterController as UserRegisterController;
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



Route::post('/user/register',[UserRegisterController::class,'createUser']);

Route::post('/login',[LoginController::class,'login']);
Route::post('/editProfile',[EditProfileController::class,'edit']);
// Route::post('/user/login',[LoginController::class,'login']);
// Route::post('/admin/login',[LoginController::class,'login']);
// Route::post('/employee/login',[LoginController::class,'login']);
// Route::post('/technicalEmployee/login',[LoginController::class,'login']);
// Route::prefix('/admin')->middleware('auth:sanctum')->middleware('is.admin'){

//     Route::post('/createEmployee',[CreateEmployeeController::class,'create']);
//     Route::post('/createCourse',[AddCourseController::class,'create']);
// }
Route::prefix('/admin')->middleware(['auth:sanctum', 'is.admin'])->group(function () {
    Route::post('/createEmployee', [CreateEmployeeController::class, 'create']);
    Route::post('/createCourse', [AddCourseController::class, 'create']);
});
