<?php

namespace App\Http\Controllers\Api\User\Wishlist;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Models\Course;
use App\Models\Wishlist;
use App\Services\userServices\Wishlist\WishlistServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    // private $wishlistServices;
    public function __construct(private WishlistServices $wishlistServices){

            $this->middleware([
                'auth:sanctum',
                'check.permission:wishlist-process,process'
            ])->only(['process']);

    }
    public function process($courseId)
    {
        $wishlist = $this->wishlistServices->process($courseId);
        if ($wishlist)
            $data = $this->store($courseId);
        else
            $data = $this->destroy($courseId);
        return $this->apiResponse(WishlistResource::make($data['wishlist']),$data['message'],200);
        // return $data;
// return $this->apiResponse($data['wishlist'],$data['message'],200);
    }
    public function store($courseId)
    {
        $wishlist = $this->wishlistServices->store($courseId, auth()->user()->id);
        try {
            $data['wishlist']=$wishlist;
            $data['message']=__('response/response_message.created_success');
            return $data;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
        public function destroy($courseId)
    {
        $wishlist=$this->wishlistServices->destroy($courseId, auth()->user()->id);
        try {
            $data['wishlist']=$wishlist;
            $data['message']=__('response/response_message.deleted_success');
            return $data;
        }  catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}


















//     public function index($courseId, WishlistServices $userWishlistServices)
//     {
//         $wishlist = $userWishlistServices->index($courseId);
//         if ($wishlist)
//         $data = $this->addToWishlist($courseId);
//     else
//     $data = $this->destroy($courseId);
// return $data;

// }
// public function process($courseId, WishlistServices $userWishlistServices)
// {
// }
// /**
//  * Show the form for creating a new resource.
//  */
// public function create($courseId)
// {
//     //
//     // return Course::findOrFail($courseId);
// }

// /**
//  * Store a newly created resource in storage.
//  */
// public function store(Request $request)
// {
//     //
// }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Wishlist $wishlist)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Wishlist $wishlist)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Wishlist $wishlist)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy($courseId)
//     {
//         //
//         try {

//             (new WishlistServices)->destroy($courseId, auth()->user()->id);
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//         return response()->json([
//             'status' => 'success',
//             'message' => 'deleted Successfully'
//         ]);
//     }
//     public function addToWishlist($courseId)
//     {
//         // $wishlist=Wishlist::create(['course_id'=>$courseId,'user_id'=>$id]);
//         // return $wishlist;
//         try {
//             $wishlist = (new WishlistServices)->addToWishlist($courseId, auth()->user()->id);
//             return  response()->json([
//                 'status' => 'success',
//                 'wishlist' => $wishlist,
//                 'forUser' => auth()->user(),
//                 'message' => 'added Successfully'
//             ]);
//             // $wishlist=Wishlist::create(['course_id'=>$courseId,'user_id'=>$id]);
//             // return $wishlist;
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
//     public function getWishlist(WishlistServices $userWishlistServices)
//     {
//         // return (Wishlist::where('user_id',auth()->user()->id)->first())->course;
//         try {
//             return $this->apiResponse($userWishlistServices->getWishlist(), 'success', 200);
//             // $wishlist = $userWishlistServices->getWishlist();
//             // return response()->json([
//             //     'status' => 'success',
//             //     'wishlist' => $wishlist,
//             //     'message' => 'added Successfully'
//             // ]);
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
