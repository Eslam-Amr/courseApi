<?php
// namespace App\Services;
namespace App\Services\adminServices\auth;

use App\Http\Requests\UserLoginRequest as AdminLoginRequest ;
use App\Models\Admin;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class AdminLoginServices
{
    use GeneralTrait;
    protected $model;
        public function __construct()
    {

        $this->model = new Admin();
    }
    public function login(AdminLoginRequest $request)
    {

        try {

            $validateAdmin = $request->validated();

            $admin = Admin::where('email', $request->email)->first();
            if (!$admin) return response()->json(['message' => 'invalid credentials'], 422);
            if (!Hash::check($request->password, $admin->password)) return response()->json(['message' => 'password is incorrect'], 422);
            if ($admin->role!='admin') return response()->json(['message' => 'unauthorize'], 422);
            $admin->tokens()->delete();
            $token = $admin->createToken($request->header('user-agent'));
            // dd($request->header());
            return response()->json(['user' => $admin, 'token' => $token->plainTextToken]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
}

    }

}
