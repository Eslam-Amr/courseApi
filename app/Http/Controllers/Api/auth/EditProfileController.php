<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Services\auth\EditProfileServices;
use App\Traits\GeneralTrait;
use Helper;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    use GeneralTrait;
    //
    // public function edit(Request $request){
    //     return $request;
    // }
    public function edit(EditProfileServices $editProfileServices,ProfileUpdateRequest $request){
        // return $request->region;
        try {

        $user= $editProfileServices->edit($request);
        // $regionId=Helper::getRegionId($request->region);
            // $user->update($request);
            // Helper::editProfile($request,$user,$regionId);
            return response()->json(['user'=>$this->apiResponse((new ProfileResource($user)),"successfully",200)]);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
        // return response()->json(['user'=>$user]);
        // return $request;
    }
}
// name
// email
// image
//password
