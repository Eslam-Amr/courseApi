<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\auth\UserRegisterServices;
use Helper;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends Controller
{
    //
    use GeneralTrait;

    public function createUser(UserRegisterRequest $request)
    {
        // return $request['region'];
        try {
            $data= (new UserRegisterServices)->createUser($request);
            if($data==null){
                return $this->returnError("invalid credential",422);
            }
            return $this->returnData('user',$data['user'],'success',$data['token'],200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }

    }

}
