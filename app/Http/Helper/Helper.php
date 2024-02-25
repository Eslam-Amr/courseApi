<?php

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Empolyee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Helper
{
    public static function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $user;
    }
    public static function createToken($user)
    {
        //     $token = $user->createToken("API TOKEN")->plainTextToken;
        // return $token;
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
    public static function registerUserVaildation($request){
        // $validateUser = Validator::make($request->all(),
        // [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);
            return $validateUser;
    }
    public static function loginUserVaildation($request){

        $validateUser = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);
            return $validateUser;
    }
    public static function createEmployee(CreateEmployeeRequest $request){
        DB::beginTransaction();

        $validateUser = $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'employee',
            'gender' => $request->gender,
            'password' => Hash::make($request->password)
        ]);
        Empolyee::create([
            'user_id' => $user->id,
            'salary' => $request->salary,
            'role' => $request->role,
            'working_hour' => $request->working_hour,
            'working_place' => $request->working_place,
        ]);
        DB::commit();
return $user;
    }
}
