<?php
// namespace App\Services;
namespace App\Services\auth;

use App\Http\Requests\UserLoginRequest  ;
use App\Models\Admin;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class LoginServices
{
    use GeneralTrait;

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd(!$user);
            if ($user==null) return response()->json(['message' => 'invalid credentials'], 422);
            if (!Hash::check($request->password, $user->password)) return response()->json(['message' => 'password is incorrect'], 422);
            // if ($admin->role!='admin') return response()->json(['message' => 'unauthorize'], 422);
            $user->tokens()->delete();
            $token = $user->createToken($request->header('user-agent'));
            // dd($request->header());
            return ['token' => $token->plainTextToken, 'user' => $user];
            // return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
        // } catch (\Throwable $ex) {
            // return $this->returnError($ex->getCode(), $ex->getMessage());
// }

    }

}
