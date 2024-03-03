<?php
// namespace App\Services;
namespace App\Services\adminServices\employeeControl;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class CreateEmployeeServices
{
    use GeneralTrait;

    public function create(CreateEmployeeRequest $request)
    {
        // try {
            $user=Helper::createEmployee($request);
            // return response()->json([
            //     'status' => true,
            //     'message' => 'employee Created Successfully',
            //     'token' => $user->createToken("API TOKEN")->plainTextToken
            // ], 200);
            return $user;
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }

    }
}
