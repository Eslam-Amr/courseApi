<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\auth\EditProfileServices;
use Helper;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    //
    // public function edit(Request $request){
    //     return $request;
    // }
    public function edit(EditProfileServices $editProfileServices,ProfileUpdateRequest $request){
        // return $request;
        try {

        $user= $editProfileServices->edit();
            // $user->update($request);
            Helper::editProfile($request,$user);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
        return response()->json(['user'=>$user]);
        // return $request;
    }
}
// name
// email
// image
//password
