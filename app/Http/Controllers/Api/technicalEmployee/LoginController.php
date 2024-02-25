<?php

namespace App\Http\Controllers\Api\technicalEmployee;

use App\Http\Controllers\Controller;
use App\Services\technicalEmployeeServices\auth\TechnicalEmployeeLoginServices;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest as TechnicalEmployeeLoginRequest;

class LoginController extends Controller
{
    //
    public function login(TechnicalEmployeeLoginRequest $request){
// dd($request);
return (new TechnicalEmployeeLoginServices)->login($request);
    }
}
