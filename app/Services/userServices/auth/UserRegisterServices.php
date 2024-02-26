<?php
// namespace App\Services;
namespace App\Services\userServices\auth;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
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

    public function createUser(UserRegisterRequest $request)
    {
        // try {

            $user = User::create([
                // 'id'=>1,
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'student',
                'gender' => $request->gender,
                // 'image' => $request->gender,
                // 'dateOfBirth' => $request->gender,
                'password' => Hash::make($request->password)
            ]);
            // dd($user);
// $user=User::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }

}
