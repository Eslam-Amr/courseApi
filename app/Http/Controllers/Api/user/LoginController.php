<?php

namespace App\Http\Controllers\Api\user;



use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\UserRegisterServices;
use Helper;
use App\Traits\GeneralTrait;

class LoginController extends Controller
{
    //


    use GeneralTrait;

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
             if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user) return response()->json(['message' => 'invalid credentials'], 422);
            if (!Hash::check($request->password, $user->password)) return response()->json(['message' => 'password is incorrect'], 422);
            if ($user->role!='student') return response()->json(['message' => 'unauthorize'], 422);
            $user->tokens()->delete();
            $token = $user->createToken($request->header('user-agent'));
            return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
}
        // dd(User::get());
        // dd(config('auth.guards'));
        // dd($user,User::get());
        // return response()->json(['message' =>]);
        // dd(Auth::guard('sanctum')->attempt($request->all()));
//         try {
//             $rules = [
//                 "email" => "required",
//                 "password" => "required"

//             ];

//             $validator = Validator::make($request->all(), $rules);
//             if ($validator->fails()) {
//                 $code = $this->returnCodeAccordingToInput($validator);
//                 return $this->returnValidationError($code, $validator);
//             }

//             //login
//             $credentials = $request->only(['email', 'password']);
// //             if (Auth::guard('sanctum')->attempt($credentials)) {
// //                 // Authentication successful, generate token
// //                 $token = Auth::guard('sanctum')->user()->createToken('token-name')->plainTextToken;
// // dd($token);
// //             }

//             // $token = Auth::guard('user-api')->attempt($credentials);  //generate token
//             $token = Auth::attempt($credentials);  //generate token

//             dd(Auth::attempt($credentials));
//             dd($token);
//             if (!$token)
//                 return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

//             // $user = Auth::guard('user-api')->user();
//             $user = Auth::user();
//             $user ->api_token = $token;
//             //return token
//             return $this->returnData('user', $user);  //return json response

//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
    }


    // public function login(Request $request)
    // {
    //     // dd(auth()->factory()->getTTL());

    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'email' => 'required|email',
    //             'password' => 'required|string|min:6',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 422);
    //         }

    //         // if (! $token = Auth::attempt($validator->validated())) {
    //         //     return response()->json(['error' => 'Unauthorized'], 401);
    //         // }
    //         if (! $token = Auth::guard('user-api')->attempt($validator->validated())) {
    //             return response()->json(['error' => 'Unauthorized'], 401);
    //         }

    //         // $validatedData = $validator->validated();
    //         // $credentials = [
    //         //     'email' => $validatedData['email'],
    //         //     'password' => $validatedData['password'],
    //         // ];

    //         // if (! $token = Auth::guard('userApi')->attempt($credentials)) {
    //         //     // If authentication fails, return an error response
    //         //     return response()->json(['error' => 'Unauthorized'], 401);
    //         // }



    //         return $this->createNewToken($token);
    //     } catch (\Exception $ex) {
    //         return response()->json(['message'=>$ex->getMessage()], 422);
    //     }
    // }
    // protected function createNewToken($token){
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         // 'expires_in' => auth()->factory()->getTTL() * 60,
    //         'user' => auth()->user()
    //     ]);
    // }
    // public function login(Request $request)
    // {
    //     // try {
    //         $rules = [
    //             "email" => "required",
    //             "password" => "required"

    //         ];

    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             $code = $this->returnCodeAccordingToInput($validator);
    //             return $this->returnValidationError($code, $validator);
    //         }
    //         // dd($validator);

    //         //login

    //         $credentials = $request->only(['email', 'password']);

    //         // $token = Auth::guard('userApi')->attempt($credentials);  //generate token
    //         $token = Auth::attempt($credentials);  //generate token
    //         // dd($token);

    //         if (!$token)
    //         return response()->json(['data'=>'not found']);
    //         // return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

    //         // $user = Auth::guard('userApi')->user();
    //         $user = Auth::user();
    //         $user->api_token = $token;
    //         //return token
    //         return response()->json(['user'=>$user]);
    //         // return $this->returnData('user', $user);  //return json response

    //     // } catch (\Exception $ex) {
    //     //     return $this->returnError($ex->getCode(), $ex->getMessage());
    //     // }
    // }
}
