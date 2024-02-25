<?php

namespace App\Http\Controllers\Api\user;



use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\userServices\auth\UserLoginServices;
use Helper;
use App\Traits\GeneralTrait;

class LoginController extends Controller
{
    //
    use GeneralTrait;
    public function login(UserLoginRequest $request)
    {
        return (new UserLoginServices)->login($request);
    }
}
