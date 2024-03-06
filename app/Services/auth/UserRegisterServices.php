<?php
// namespace App\Services;
namespace App\Services\auth;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegisterServices
{
    // protected $model;
    // public function __construct()
    // {
    //     $this->model = new User();
    // }

    public function createUser(UserRegisterRequest $request)
    {
        if ($request->role == 'admin')
            return null;
        // try {
        if (isset($request['region']))
            $regionId = Helper::getRegionId($request['region']);
        else
        $regionId = null;
        $user = Helper::createUser($request,$regionId,'student');
        // dd($user);
        // $user=User::create($request->validated());
        $token = $user->createToken($request->header('user-agent'));
        return ['token' => $token->plainTextToken, 'user' => $user];
        // return response()->json([
        //     'status' => true,
        //     'message' => 'User Created Successfully',
        //     'token' => $user->createToken("API TOKEN")->plainTextToken
        // ], 200);

        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }
}
