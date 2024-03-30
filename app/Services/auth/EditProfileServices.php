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
use Illuminate\Support\Facades\Auth;

class EditProfileServices
{
    use GeneralTrait;

    public function edit($request)
    {
        // dd($request->all()['region_id']);
        // $user = Auth::user();
        $user = User::where('id', auth()->user()->id)->first();
        // if ($user == null)
        // return null;
    // Helper::editProfile($request,$user);
     $user->update($request->validated());
    // var_dump($user);
    // return $result;
    // die;

//    return auth()->user()->update($request->validated());
    // auth()->user()->update($request->validated());

    // $user->update([
    //     'name' => isset($request->name)?$request->name:$user->name,
    //     'email' => isset($request->email)?$request->email:$user->email,
    //     'password' => isset($request->password)? Hash::make($request->password) : $user->password
    // ]);


    // $regionId=Helper::getRegionId($request->region);
            // $user->update($request);
        // if (!Hash::check($request->password, $user->password))
        // return null;
        // $user->tokens()->delete();
        // $token = $user->createToken($request->header('user-agent'));
        return $user;
    }
}
