<?php

namespace App\Http\Controllers;

use App\Actions\CourseActions\CourseAction;
use App\Http\Requests\CourseRegistrationRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\UserServices\CourseServices\CourseRegistrationServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    //
    use GeneralTrait;
    public function store(CourseRegistrationRequest $request, CourseRegistrationServices $courseRegistrationServices, CourseAction $courseAction)
    {
        $group = Group::select('max_student', 'registered_student', 'id')->findOrFail($request->group_id);
        if ($courseAction->handle($group->id))
            return $this->apiResponse('null', 'this course already registered', 302);
        if ($group['max_student'] == $group['registered_student'])
            return $this->apiResponse('null', 'no place to register in ', 302);
        $user = $courseRegistrationServices->store($group);
        return $this->apiResponse($user,'success',200);

    }
    public function destroy($groupId, CourseRegistrationServices $courseRegistrationServices){
        $session=$courseRegistrationServices->destroy($groupId);
      if($session==null)
        return $this->apiResponse('null', 'already deleted successfuly', 200);
        return $this->apiResponse('null', 'deleted successfuly', 200);

        // } catch (\Exception $ex) {
    //     return $this->returnError($ex->getCode(), $ex->getMessage());
    // }
    }
}








// public function index(SessionServices $sessionServices)
// {
//     $sessions = $sessionServices->index();
//     try {

//         return $this->apiResponse($sessions, 'success', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
// }



// /**
//  * Store a newly created resource in storage.
//  */
// public function store(SessionRequest $request, $groupId, SessionServices $sessionServices)
// {
//     //
//     // $group=Group::find($groupId);
//     // if(!$group)
//     // return $this->returnError(404, 'Group not found');
//     //code...
//     try {

//         return $this->apiResponse($sessionServices->store($request, $groupId), 'success', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
// }

// /**
//  * Display the specified resource.
//  */
// public function show($sessionId,SessionServices $sessionServices)
// {
//     $session=$sessionServices->show($sessionId);
//     // return $session;
//     // return $session->group->course;
//     try {

//         return $this->apiResponse((new SessionResource($session)), 'success', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
//     //
// }



// /**
//  * Update the specified resource in storage.
//  */
// public function update(SessionUpdateRequest $request, $sessionId, SessionServices $sessionServices)
// {
//     try {

//         return $this->apiResponse($sessionServices->update($request, $sessionId), 'success', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
// }

// /**
//  * Remove the specified resource from storage.
//  */
// public function destroy($sessionId,SessionServices $sessionServices)
// {
//     try {

//         return $this->apiResponse($sessionServices->destroy($sessionId), 'deleted successfuly', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
//     //

// }
