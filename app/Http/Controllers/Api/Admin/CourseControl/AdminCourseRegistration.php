<?php

namespace App\Http\Controllers\Api\Admin\CourseControl;

use App\Actions\CourseActions\CourseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistrationAdminDestroyRequest;
use App\Http\Requests\CourseRegistrationAdminRequest;
use App\Models\Group;
use App\Models\GroupUser;
use App\Services\UserServices\CourseServices\CourseRegistrationServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AdminCourseRegistration extends Controller
{
    use GeneralTrait;

    public function store(CourseRegistrationAdminRequest $request, CourseRegistrationServices $courseRegistrationServices, CourseAction $courseAction)
    {
        $group = Group::select('max_student', 'registered_student', 'id')->findOrFail($request->group_id);
        if ($courseAction->handle($group->id,$request->user_id))
            return $this->apiResponse('null', 'this course already registered', 302);
        if ($group['max_student'] == $group['registered_student'])
            return $this->apiResponse('null', 'no place to register in ', 302);
        $user = $courseRegistrationServices->store($group,$request->user_id);
        return $this->apiResponse($user, 'success', 200);
    }

    public function destroy($groupId,CourseRegistrationAdminDestroyRequest $request ,CourseRegistrationServices $courseRegistrationServices)
    {
        $session = $courseRegistrationServices->destroy($groupId,$request->user_id);
        if ($session == null)
            return $this->apiResponse('null', 'already deleted successfuly', 200);
        return $this->apiResponse('null', 'deleted successfuly', 200);

    }
    public function index(CourseRegistrationServices $courseRegistrationServices)
    {
        $groups = GroupUser::paginate();
        try {

            return $this->apiResponse($groups, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}

// public function show($groupId, CourseRegistrationServices $courseRegistrationServices)
// {
//     $group = $courseRegistrationServices->show($groupId);
//     try {
//         return $this->apiResponse($group, 'success', 200);
//     } catch (\Exception $ex) {
//         return $this->returnError($ex->getCode(), $ex->getMessage());
//     }
// }
