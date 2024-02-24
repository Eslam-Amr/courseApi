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

    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Helper::registerUserVaildation($request);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // public function createUser(Request $request)
    // {
    //     // dd('sjk');
    //     $validateUser = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required'
    //     ]);

    //     // Check if validation fails
    //     if ($validateUser->fails()) {
    //         // Validation failed
    //         // Handle the validation errors
    //         return response()->json([
    //             'status' => false,
    //             'message' => $validateUser->errors()->first() // Return the first validation error message
    //         ], 422);
    //     }

    //     // Validation passed
    //     // Proceed with your logic

    //     // $validateUser =Helper::registerUserVaildation($request);
    //     // dd($validateUser);
    //     try {
    //         // $validateUser = Validator::make($request->all(),
    //         // [
    //         //     // 'name' => 'required',
    //         //     'email' => 'required|email|unique:users,email',
    //         //     'password' => 'required'
    //         // ]);
    //         // $validateUser = $this->vaildate($request);
    //         // dd($validateUser);
    //         // $user = Helper::createUser($validateUser);
    //         $user = Helper::createUser($validateUser);
    //         // return response()->json([
    //         //                 'status' => true,
    //         //                 'message' => 'User Created Successfully',
    //         //                 'token' => $user->createToken("API TOKEN")->plainTextToken
    //         //             ], 200);
    //         Helper::createToken($user);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }
    // public function createUser(Request $request)
    // {
// dd($request->all());

        // $validateUser = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'gender' => 'required'
        // ]);

        // Check if validation fails
        // if ($validateUser->fails()) {
        //     // Validation failed, handle the errors
        //     // You can access the validation errors using $validateUser->errors()
        //     // For example: return response()->json($validateUser->errors(), 422);
        // } else {
        //     // Validation passed
        //     // Get only the validated data
        //     $validatedData = $validateUser->validated();

        //     // Do something with the validated data
        //     // For example, you can use it to create or update a user
        //     // dd($validatedData);
        // }

        // $user=$userRegisterServices->createUser($request);
        // return response()->json([
        //  'status' => true,
        //  'message' => 'User Created Successfully'
        //  ,
        //  'data'=>$user
        // ], 200);
        // $validateUser = Validator::make($request->all(),
        // [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required'
        // ]);
        // dd($validateUser);
        // dd(Helper::registerUserVaildation($request->all()));
        // return (new UserRegisterServices())->createUser($request);


            // $validateUser = Validator::make($request->all(),
            // [
            //     'name' => 'required',
            //     'email' => 'required|email',
            //     'password' => 'required',
            //     'gender' => 'required'

            // ]);
            // // dd($validateUser->validated());
            // $validateUser =Helper::registerUserVaildation($request);
            // try {
            //     // $validateUser = $this->vaildate($request);
            //     // dd($validateUser);
            //     $user = Helper::createUser($validateUser);
            //     // return response()->json([
            //     //                 'status' => true,
            //     //                 'message' => 'User Created Successfully',
            //     //                 'token' => $user->createToken("API TOKEN")->plainTextToken
            //     //             ], 200);
            //     Helper::createToken($user);
            // } catch (\Throwable $th) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => $th->getMessage()
            //     ], 500);
            // }




        // try {
        //     //Validated
        //     $validateUser = Validator::make($request->all(),
        //     [
        //         'name' => 'required',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required'
        //     ]);

        //     if($validateUser->fails()){
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'validation error',
        //             'errors' => $validateUser->errors()
        //         ], 401);
        //     }

        //     $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password)
        //     ]);

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'User Created Successfully',
        //         'token' => $user->createToken("API TOKEN")->plainTextToken
        //     ], 200);

        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    // }
    // public function createUser(UserLoginRequest $request)
    // {
    //     // dd("eslam");
    //     // return (new UserRegisterServices())->createUser($request);
    //     // return (new \App\Services\UserRegisterServices())->createUser($request);
    //     //   dd(User::where('email',$request->email)->first()!=null);
    //     if (User::where('email', $request->email)->first() != null) {

    //         return response()->json([
    //             'message' => "this email is exist"
    //         ], 201);
    //     }
    //     // dd($request);
    //     try {
    //         //Validated
    //         $validateUser = Validator::make(
    //             $request->all(),
    //             [
    //                 'name' => 'required',
    //                 'email' => 'required|email',
    //                 'password' => 'required',
    //                 'gender' => 'required'

    //                 //  (new App\Services\UserRegisterServices())->createUser($request);

    //                 //  use App\Services\UserRegisterServices;

    //                 //  Then, somewhere in your code...
    //                 //  $userRegisterServices = new UserRegisterServices();
    //                 //  $userRegisterServices->createUser($request);




    //             ]
    //         );
    //         if (User::where('email', $request->email) != null)
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => "this email is exist"
    //             ], 201);
    //         if ($validateUser->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }

    //         $user = User::create([
    //             'name' => $request->name,
    //             'gender' => $request->gender,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password)
    //         ]);

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
    //     return response()->json([
    //         'status' => false,
    //         'message' => "this email is exist"
    //     ], 201);
    // }
}
