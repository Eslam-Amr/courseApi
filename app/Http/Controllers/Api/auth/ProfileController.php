<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function profile(){
        return response()->json(['user'=>new ProfileResource(auth()->user())]);

    }
}
