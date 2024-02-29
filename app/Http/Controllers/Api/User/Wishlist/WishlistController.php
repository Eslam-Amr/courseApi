<?php

namespace App\Http\Controllers\Api\User\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Wishlist;
use App\Services\userServices\Wishlist\UserWishlistServices;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId,UserWishlistServices $userWishlistServices)
    {
        $wishlist= $userWishlistServices->index($courseId);
        if($wishlist)
       $data=$this->addToWishlist($courseId);
else
$data=$this->destroy($courseId);
return $data;
//         $wishlist= $userWishlistServices->index($courseId);
//         if($wishlist)
//         return  response()->json([
//             'status'=>'success',
//             'wishlist'=>$wishlist,
//             'forUser'=>auth()->user(),
//             'message'=>'added Successfully'
//         ]);
// else
// return response()->json([
//     'status'=>'success',
//     'message'=>'deleted Successfully'
// ]);
        // return auth()->user();
        //
        // try {
        //     $course = $userWishlistServices->index($courseId);
        //     return $course;
        // } catch (\Throwable $ex) {
        //     return $this->returnError($ex->getCode(), $ex->getMessage());
        // }
                //  return Course::findOrFail($courseId);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        //
        return Course::findOrFail($courseId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId)
    {
        //
        try {

            (new UserWishlistServices)->destroy($courseId,auth()->user()->id);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
        return response()->json([
            'status'=>'success',
            'message'=>'deleted Successfully'
        ]);
    }
    public function addToWishlist($courseId){
        // $wishlist=Wishlist::create(['course_id'=>$courseId,'user_id'=>$id]);
        // return $wishlist;
        try {
            $wishlist=(new UserWishlistServices)->addToWishlist($courseId,auth()->user()->id);
            return  response()->json([
                'status'=>'success',
                'wishlist'=>$wishlist,
                'forUser'=>auth()->user(),
                'message'=>'added Successfully'
            ]);
            // $wishlist=Wishlist::create(['course_id'=>$courseId,'user_id'=>$id]);
            // return $wishlist;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
        }
}
