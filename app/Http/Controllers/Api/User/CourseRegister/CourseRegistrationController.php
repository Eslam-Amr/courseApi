<?php

namespace App\Http\Controllers\Api\User\CourseRegister;

use App\Actions\CourseActions\CourseAction;
use App\Http\Controllers\Controller;
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
        if ($courseAction->handle($group->id,auth()->user()->id))
            return $this->apiResponse('null', 'this course already registered', 302);
        if ($group['max_student'] == $group['registered_student'])
            return $this->apiResponse('null', 'no place to register in ', 302);
        $user = $courseRegistrationServices->store($group,auth()->user()->id);
        return $this->apiResponse($user, 'success', 200);
    }
    public function destroy($groupId, CourseRegistrationServices $courseRegistrationServices)
    {
        $session = $courseRegistrationServices->destroy($groupId,auth()->user()->id);
        if ($session == null)
            return $this->apiResponse('null', 'already deleted successfuly', 200);
        return $this->apiResponse('null', 'deleted successfuly', 200);

        // } catch (\Exception $ex) {
        //     return $this->returnError($ex->getCode(), $ex->getMessage());
        // }
    }
    public function index(CourseRegistrationServices $courseRegistrationServices)
    {
        $groups = $courseRegistrationServices->index(auth()->user()->id);
        try {

            return $this->apiResponse($groups, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function show($groupId, CourseRegistrationServices $courseRegistrationServices)
    {
        $group = $courseRegistrationServices->show($groupId,auth()->user()->id);
        try {
            return $this->apiResponse($group, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}

