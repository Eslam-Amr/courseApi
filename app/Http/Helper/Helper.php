<?php

use App\Models\User;
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
}
