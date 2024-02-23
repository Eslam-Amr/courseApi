<?php

use App\Http\Controllers\Api\user\LoginController;
use App\Http\Controllers\Api\user\RegisterController;
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
Route::post('/user/login',[LoginController::class,'login']);
Route::post('/user/register',[RegisterController::class,'createUser']);
