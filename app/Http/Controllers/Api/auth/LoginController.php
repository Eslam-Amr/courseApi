<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\auth\LoginServices;
use App\Services\userServices\auth\UserLoginServices;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class LoginController extends Controller
{
    use GeneralTrait;
    public function login(UserLoginRequest $request,LoginServices $LoginServices){
        try {
            $data= $LoginServices->login($request);
            if($data==null){
                return $this->returnError("invalid credential",422);
            }
            return $this->returnData('user',$data['user'],'success',$data['token'],200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
    }
}

// $data= (new LoginServices)->login($request);
// $data= $this->LoginService->login($request);

    //
//     public $LoginService;
//     public function __construct(LoginServices $loginService){
// $this->LoginService=$loginService;
//     }
