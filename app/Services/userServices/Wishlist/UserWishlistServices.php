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

class UserWishlistServices
{
    use GeneralTrait;

    // public function login(UserLoginRequest $request)
    // {
    //     $user = User::where('email', $request->email)->first();
    //     if ($user == null)
    //     return null;
    //     if (!Hash::check($request->password, $user->password))
    //     return null;
    //     $user->tokens()->delete();
    //     $token = $user->createToken($request->header('user-agent'));
    //     return ['token' => $token->plainTextToken, 'user' => $user];
    // }

    public function index($courseId){
            Course::findOrFail($courseId);
            if(Helper::checkIfWishlistExists($courseId,auth()->user()->id)){
return false;
                // $this->destroy($courseId,auth()->user()->id);
            }
            else{
             return true;
                // return  $this->addToWishlist($courseId,auth()->user()->id);
            }
            // if(Helper::checkIfWishlistExists($courseId,auth()->user()->id)){

            //     $this->destroy($courseId,auth()->user()->id);
            // }
            // else{
            //     return  $this->addToWishlist($courseId,auth()->user()->id);
            // }


}
public function destroy($courseId,$id){
$wishlist=Wishlist::where('course_id',$courseId)->where('user_id',$id);
$wishlist->delete();
}
public function addToWishlist($courseId,$id){
$wishlist=Wishlist::create(['course_id'=>$courseId,'user_id'=>$id]);
return $wishlist;
}
}
// if (!Hash::check($request->password, $user->password)) return response()->json(['message' => 'password is incorrect'], 422);
// if ($user == null) return response()->json(['message' => 'invalid credentials'], 422);
// dd(!$user);
// if ($admin->role!='admin') return response()->json(['message' => 'unauthorize'], 422);
    // dd($request->header());
    // return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
// } catch (\Throwable $ex) {
    // return $this->returnError($ex->getCode(), $ex->getMessage());
// }
