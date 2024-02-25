<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Services\adminServices\auth\AdminLoginServices;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(AdminLoginRequest $request)
    {
        return (new AdminLoginServices)->login($request);
    }
}
