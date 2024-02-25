<?php

use App\Http\Controllers\Api\admin\CreateEmployeeController;
use App\Http\Controllers\Api\admin\LoginController as AdminLoginController;
use App\Http\Controllers\Api\employee\LoginController as EmployeeLoginController;
use App\Http\Controllers\Api\technicalEmployee\LoginController as TechnicalEmployeeLoginController;
use App\Http\Controllers\Api\techniaclEmployee\LoginController;
use App\Http\Controllers\Api\user\LoginController as UserLoginController;
use App\Http\Controllers\Api\user\RegisterController as UserRegisterController;
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
    return  User::all();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/user/login',[UserLoginController::class,'login']);
Route::post('/user/register',[UserRegisterController::class,'createUser']);




Route::post('/admin/login',[AdminLoginController::class,'login']);
Route::post('/admin/createEmployee',[CreateEmployeeController::class,'create']);
Route::post('/employee/login',[EmployeeLoginController::class,'login']);
Route::post('/technicalEmployee/login',[TechnicalEmployeeLoginController::class,'login']);
