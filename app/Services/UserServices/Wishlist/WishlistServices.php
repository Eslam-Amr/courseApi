<?php
// namespace App\Services;
namespace App\Services\userServices\Wishlist;

use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use App\Models\Course;
use App\Models\User;
use App\Models\Wishlist;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class WishlistServices
{
    use GeneralTrait;
    public function process($courseId)
    {
        Course::findOrFail($courseId);
        if (Helper::checkIfWishlistExists($courseId, auth()->user()->id)) {
            return false;
        } else {
            return true;
        }
    }
    public function store($courseId, $id)
    {
        $wishlist = Wishlist::create(['course_id' => $courseId, 'user_id' => $id]);
        return $wishlist;
    }
    public function destroy($courseId, $id)
    {
        // $wishlist = Wishlist::where('course_id', $courseId)->where('user_id', $id)->first();
        // // Wishlist::where('course_id', $courseId)->where('user_id', $id)->delete();
        // $wishlist->delete();
        // return $wishlist;
        $wishlist = Wishlist::where('course_id', $courseId)->where('user_id', $id)->first();
        $wishlist->delete();
        return $wishlist;
    }
}

// public function index($courseId)
// {
//     Course::findOrFail($courseId);
//     if (Helper::checkIfWishlistExists($courseId, auth()->user()->id)) {
//         return false;
//         // $this->destroy($courseId,auth()->user()->id);
//     } else {
//         return true;
//         // return  $this->addToWishlist($courseId,auth()->user()->id);
//     }
//     // if(Helper::checkIfWishlistExists($courseId,auth()->user()->id)){

//     //     $this->destroy($courseId,auth()->user()->id);
//     // }
//     // else{
//     //     return  $this->addToWishlist($courseId,auth()->user()->id);
//     // }


// }
// public function destroy($courseId, $id)
// {
//     $wishlist = Wishlist::where('course_id', $courseId)->where('user_id', $id);
//     $wishlist->delete();
// }
// public function addToWishlist($courseId, $id)
// {
//     $wishlist = Wishlist::create(['course_id' => $courseId, 'user_id' => $id]);
//     return $wishlist;
// }
// public function getWishlist()
// {

//     $wishlist = Wishlist::with('course')->where('user_id', auth()->user()->id)->paginate();
//     return $wishlist;
// }
