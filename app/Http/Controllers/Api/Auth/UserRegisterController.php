<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\AuthResource;
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
    public function __construct(){
        $this->middleware([
            'guest',
            // 'check.permission:user-createAccount,register'
        ])->only(['createUser']);
    }

    public function createUser(UserRegisterRequest $request)
    {
        // return $request;
        try {
            $data= (new UserRegisterServices)->createUser($request);
            if($data==null){
                return $this->returnError(__('response/response_message.invalid_credentials'),422);
            }
            return $this->apiResponse(AuthResource::make($data),__('response/response_message.created_success'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }

    }

}
