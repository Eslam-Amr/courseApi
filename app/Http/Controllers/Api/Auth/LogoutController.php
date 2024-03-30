<?php

namespace App\Http\Controllers\Api\Auth;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
use GeneralTrait;
public function __construct(){
    $this->middleware(['auth:sanctum'])->only(['logout']);
}
    // Auth::user()->tokens()->delete();
    public function logout(){
        Auth::user()->tokens()->delete();
return $this->apiResponse('',__("response/response_message.logout_success"),200);
    }
}
