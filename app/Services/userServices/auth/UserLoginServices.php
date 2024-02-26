<?php
// namespace App\Services;
namespace App\Services\userServices\auth;

use App\Http\Requests\UserLoginRequest;
use App\Models\Student;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class UserLoginServices
{
    use GeneralTrait;
    protected $model;
    public function __construct()
    {

        $this->model = new Student();
    }
    public function login(UserLoginRequest $request)
    {

        try {

            $validateUser = $request->validated();

            $user = User::where('email', $request->email)->first();
            if (!$user) return response()->json(['message' => 'invalid credentials'], 422);
            if (!Hash::check($request->password, $user->password)) return response()->json(['message' => 'password is incorrect'], 422);
            // if ($user->role != 'student') return response()->json(['message' => 'unauthorize'], 422);
            // $user->tokens()->delete();
            $token = $user->createToken($request->header('user-agent'));
            return response()->json(['user' => $user, 'token' => $token->plainTextToken,'message' => $request->header()]);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
