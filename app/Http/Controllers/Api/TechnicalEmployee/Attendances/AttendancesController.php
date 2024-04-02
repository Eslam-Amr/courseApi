<?php

namespace App\Http\Controllers\APi\TechnicalEmployee\Attendances;

use App\Actions\AttendancesActions\AttendancesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendancesRequest;
use App\Http\Requests\AttendancesUpdateRequest;
use App\Http\Resources\AttendanceCollection;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendances;
use App\Services\AdminServices\AttendancesServices\AttendancesServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:attendance-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:attendance-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:attendance-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:attendance-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:attendance-show,show'
        ])->only(['show']);
    }
    public function index(AttendancesServices $attendancesServices)
    {
        $attendance = $attendancesServices->index();
        return $this->apiResponse(AttendanceCollection::make($attendance), __('response/response_message.data_retrieved'), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendancesRequest $request, AttendancesServices $attendancesServices, AttendancesAction $attendancesAction)
    {
        //
        $ifExists = $attendancesAction->handle($request->session_id, $request->user_id);
        if ($ifExists == 1) {
            return $this->apiResponse('', __('response/response_message.already_exist'), 302);
        }
        $attendance = $attendancesServices->store($request);
        // dd($attendance);
        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.created_success'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($attendancesId, AttendancesServices $attendancesServices)
    {
        //
        $attendance = $attendancesServices->show($attendancesId);
        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.data_retrieved'), 200);
    }
    public function showForSession($sessionId, AttendancesServices $attendancesServices)
    {
        //
        $attendance = $attendancesServices->showForSession($sessionId);
        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.data_retrieved'), 200);
    }
    public function showForUser($userId, AttendancesServices $attendancesServices)
    {
        //
        $attendance = $attendancesServices->showForUser($userId);
        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.data_retrieved'), 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(AttendancesUpdateRequest $request, $id, AttendancesServices $attendancesServices)
    {
        $attendance = $attendancesServices->update($request, $id);

        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.updated_success'), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, AttendancesServices $attendancesServices)
    {
        $attendance = $attendancesServices->destroy($id);

        return  $this->apiResponse(AttendanceResource::make($attendance), __('response/response_message.deleted_success'), 200);

    }
}
