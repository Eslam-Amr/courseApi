<?php
// namespace App\Services;
namespace App\Services\employeeServices\auth;

use App\Http\Requests\UserLoginRequest as EmployeeLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class EmployeeLoginServices
{
    use GeneralTrait;
    protected $model;
    public function __construct()
    {

        $this->model = new User();
    }
    public function login(EmployeeLoginRequest $request)
    {
        try {
            // $data = $request->validated();
            $employee = User::where('email', $request->email)->first();
            if (!$employee) return response()->json(['message' => 'invalid credentials'], 422);
            if (!Hash::check($request->password, $employee->password)) return response()->json(['message' => 'password is incorrect'], 422);
            if ($employee->role != 'employee') return response()->json(['message' => 'unauthorize'], 401);
            if ($employee->employee == null) return response()->json(['message' => 'some things went wrong'], 422);
            $employee->tokens()->delete();
            $token = $employee->createToken($request->header('user-agent'));
            return response()->json(['user' => $employee, 'token' => $token->plainTextToken]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
