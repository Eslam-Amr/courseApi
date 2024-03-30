<?php

namespace App\Http\Controllers\Api\User\CourseRegister;

use App\Actions\CourseActions\CourseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRegistrationRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\User;
use App\Services\UserServices\CourseServices\CourseRegistrationServices;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    //
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:course-registeration-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:course-registeration-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:course-registeration-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:course-registeration-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:course-registeration-show,show'
        ])->only(['show']);
    }
    public function store(CourseRegistrationRequest $request, CourseRegistrationServices $courseRegistrationServices, CourseAction $courseAction)
    {
        $group = Group::select('max_student', 'registered_student', 'id','course_id')->findOrFail($request->group_id);
        if ($courseAction->handle($group->id,auth()->user()->id))
            return $this->apiResponse('', __('response/response_message.already_registered'), 302);
        if ($group['max_student'] == $group['registered_student'])
            return $this->apiResponse('', __('response/response_message.already_complete') , 302);
        $user = $courseRegistrationServices->store($group,auth()->user()->id);
        return $this->apiResponse(UserResource::make($user),  __('response/response_message.created_success'), 200);
    }
    public function destroy($groupId, CourseRegistrationServices $courseRegistrationServices)
    {
        $group = Group::findOrFail($groupId);
        $startDate = Carbon::parse($group->start_date);
        $currentDate = Carbon::now();
        $weeksDifference = $currentDate->diffInWeeks($startDate);
        if ($weeksDifference < 2) {
            // dd($weeksDifference,$startDate,$currentDate,$weeksDifference<2);
            return $this->apiResponse('null',  __('response/response_message.can_not_delete_before_2_weeks'), 200);
        }
        $session = $courseRegistrationServices->destroy($groupId,auth()->user()->id);
        if ($session == null)
            return $this->apiResponse('null', __('response/response_message.already_deleted_success'), 200);
        return $this->apiResponse('null',  __('response/response_message.deleted_success'), 200);

        // } catch (\Exception $ex) {
        //     return $this->returnError($ex->getCode(), $ex->getMessage());
        // }
    }
    public function index(CourseRegistrationServices $courseRegistrationServices)
    {
        $groups = $courseRegistrationServices->index(auth()->user()->id);
        try {

            return $this->apiResponse(GroupCollection::make($groups), __('response/response_message.data_retrieved'), 200);
            // return $groups;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function show($groupId, CourseRegistrationServices $courseRegistrationServices)
    {
        $group = $courseRegistrationServices->show($groupId,auth()->user()->id);
        try {
            return $this->apiResponse(GroupResource::make($group),  __('response/response_message.created_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}

