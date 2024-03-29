<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use App\Http\Resources\AssignmentCollection;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Services\AdminServices\AssignmentServices\AssignmentServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-show,show'
        ])->only(['show']);
    }
    public function index(AssignmentServices $assignmentServices)
    {
        $assignment = $assignmentServices->index();
        try {

            return $this->apiResponse(AssignmentCollection::make($assignment), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request, AssignmentServices $assignmentServices)
    {

        $assignment = $assignmentServices->store($request);
        try {
            return $this->apiResponse(AssignmentResource::make($assignment), __('response/response_message.created_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($assignmentId, AssignmentServices $assignmentServices)
    {
        $assignment = $assignmentServices->show($assignmentId);
        try {
            return $this->apiResponse(AssignmentResource::make($assignment), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(AssignmentUpdateRequest $request, $id, AssignmentServices $assignmentServices)
    {
        $assignment = $assignmentServices->update($request, $id);
        try {
            return $this->apiResponse(AssignmentResource::make($assignment), __('response/response_message.updated_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy($assignmentId, AssignmentServices $assignmentServices)
    {
        $assignment = $assignmentServices->destroy($assignmentId);
        try {
            return $this->apiResponse(AssignmentResource::make($assignment), __('response/response_message.deleted_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //

    }
}
