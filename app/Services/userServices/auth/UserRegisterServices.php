<?php
// namespace App\Services;
namespace App\Services\userServices\auth;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegisterServices
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }
    // public function vaildate($request)
    // {
    //     // $validateUser = validator::make($request, $request->rule());
    //     // $validateUser=$request->validate();
    //     if ($validateUser->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'validation error',
    //             'errors' => $validateUser->errors()
    //         ], 401);
    //     }
    //     // dd($validateUser);
    //     return $validateUser;
    //     // return $request;
    // }


    public function createUser($request)
    {

        try {
            // $validateUser = $this->vaildate($request);
            $validateUser =$request;
            // dd($validateUser);
            $user = Helper::createUser($validateUser);
            // return response()->json([
            //                 'status' => true,
            //                 'message' => 'User Created Successfully',
            //                 'token' => $user->createToken("API TOKEN")->plainTextToken
            //             ], 200);
            Helper::createToken($user);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    // public function createUser(Request $request)
    // {
    //     // dd($request);
    //     try {
    //         //Validated
    //         $validateUser = Validator::make(
    //             $request->all(),
    //             [
    //                 'name' => 'required',
    //                 'email' => 'required|email|unique:users,email',
    //                 'password' => 'required',
    //                 'gender' => 'required'







    //             ]
    //         );

    //         if ($validateUser->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }

    //         // $user = User::create([
    //         //     'name' => $request->name,
    //         //     'gender' => $request->gender,
    //         //     'email' => $request->email,
    //         //     'password' => Hash::make($request->password)
    //         // ]);
    //         $user = Helper::createUser($request);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'User Created Successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }
}
