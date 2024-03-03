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

class EditProfileServices
{
    use GeneralTrait;

    public function edit($request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($user == null)
        return null;
        $regionId=Helper::getRegionId($request->region);
            // $user->update($request);
            Helper::editProfile($request,$user,$regionId);
        // if (!Hash::check($request->password, $user->password))
        // return null;
        // $user->tokens()->delete();
        // $token = $user->createToken($request->header('user-agent'));
        return $user;
    }
}
