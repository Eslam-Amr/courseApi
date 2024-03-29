<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
use GeneralTrait;
    //
    public function profile(){
        // return auth()->user();
        return $this->apiResponse(ProfileResource::make(auth()->user()),__('response/response_message.data_retrieved'),200);
    //    return ProfileResource::make(auth()->user(),__('response_message.login_success'));
        // return response()->json(['user'=>new ProfileResource(auth()->user())]);

    }
}
