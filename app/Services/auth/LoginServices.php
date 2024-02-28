<?php
// namespace App\Services;
namespace App\Services\auth;

use App\Http\Requests\UserLoginRequest;
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
        if ($user == null)
        return null;
        if (!Hash::check($request->password, $user->password))
        return null;
        $user->tokens()->delete();
        $token = $user->createToken($request->header('user-agent'));
        return ['token' => $token->plainTextToken, 'user' => $user];
    }
}
// if (!Hash::check($request->password, $user->password)) return response()->json(['message' => 'password is incorrect'], 422);
// if ($user == null) return response()->json(['message' => 'invalid credentials'], 422);
// dd(!$user);
// if ($admin->role!='admin') return response()->json(['message' => 'unauthorize'], 422);
    // dd($request->header());
    // return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
// } catch (\Throwable $ex) {
    // return $this->returnError($ex->getCode(), $ex->getMessage());
// }
