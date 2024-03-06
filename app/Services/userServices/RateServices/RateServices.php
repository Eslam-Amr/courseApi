<?php
// namespace App\Services;
namespace App\Services\userServices\RateServices;

use App\Http\Requests\RateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Rate;
use App\Models\User;
use App\Models\Wishlist;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class RateServices
{
    use GeneralTrait;



    public function index($courseId)
    {
    }
    public function create($courseId, RateRequest $request)
    {
        // $lastRate = Helper::checkIfRateExists($request, $courseId);
        // if ($lastRate!=null) {
        //     return "1";
        // }
        $rate = Helper::createRate($request,$courseId);
        return $rate;
    }
    public function destroy($courseId)
    {
        $rate=Rate::where('course_id',$courseId)->where('user_id',auth()->user()->id)->first();
        if ($rate != null) {
            $rate->delete();
        }
        return $rate;
    }
    public function addToWishlist($courseId, $id)
    {
    }
}
