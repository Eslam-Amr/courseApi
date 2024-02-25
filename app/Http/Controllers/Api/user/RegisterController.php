<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\userServices\auth\UserRegisterServices;
use Helper;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function createUser(UserRegisterRequest $request)
    {
        return (new UserRegisterServices)->createUser($request);

    }

}
