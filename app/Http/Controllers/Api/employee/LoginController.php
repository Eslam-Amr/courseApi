<?php

namespace App\Http\Controllers\Api\employee;

use App\Http\Controllers\Controller;
use App\Services\employeeServices\auth\EmployeeLoginServices;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest as EmployeeLoginRequest;
// use App\Services\adminServices\auth\AdminLoginServices;
class LoginController extends Controller
{
    //
    public function login(EmployeeLoginRequest $request)
    {
        return (new EmployeeLoginServices)->login($request);
    }
}
