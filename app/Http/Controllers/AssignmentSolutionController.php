<?php

namespace App\Http\Controllers;

use App\Actions\AssignmentSolutionActions\AssignmentSolutionAction;
use App\Http\Requests\AssignmentSolutionRequest;
use App\Http\Requests\AssignmentSolutionUpdateRequest;
use App\Http\Resources\AssignmentResource;
use App\Http\Resources\AssignmentSolutionCollection;
use App\Http\Resources\AssignmentSolutionResource;
use App\Models\Assignment;
use App\Models\AssignmentSolution;
use App\Services\UserServices\AssignmentSolutionServices\AssignmentSolutionServices;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentSolutionController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-solution-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-solution-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-solution-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-solution-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:assignment-solution-show,show'
        ])->only(['show']);
    }
    public function index(AssignmentSolutionServices $assignmentSolutionServices)
    {
        $assignment = $assignmentSolutionServices->index();
        try {

            return $this->apiResponse(AssignmentSolutionCollection::make($assignment), __('response/response_message.data_retrieved'), 200);
            // return $this->apiResponse($assignment, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentSolutionRequest $request, AssignmentSolutionServices $assignmentSolutionServices, AssignmentSolutionAction $assignmentSolutionAction)
    {

        $ifExists = $assignmentSolutionAction->handle($request->assignment_id, auth()->user()->id);
        if ($ifExists == 1) {
            return $this->apiResponse('', __('response/response_message.already_exist'), 302);
            // return $this->apiResponse('', 'already exists', 302);
        }
        // /*
        // check for date
        // */
        if ($ifExists == 2) {
            return $this->apiResponse('', __('response/response_message.assignment_not_active'), 302);

            // return $this->apiResponse('null', 'this assignment is not active', 302);
        }

        $assignment = $assignmentSolutionServices->store($request);
        try {

            return $this->apiResponse(AssignmentSolutionResource::make($assignment), __('response/response_message.created_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignmentSolutionServices $assignmentSolutionServices, $assignmentId)
    {
        //

        $assignmentSolution = $assignmentSolutionServices->show($assignmentId);
        try {
            return $this->apiResponse(AssignmentSolutionResource::make($assignmentSolution), __('response/response_message.data_retrieved'), 200);

            // return $this->apiResponse($assignmentSolution, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentSolutionUpdateRequest $request,$assignmentSolutionId, AssignmentSolutionServices $assignmentSolutionServices)
    {
        // update for mentor to update evaluation
        $assignmentSolutionEvaluation=$assignmentSolutionServices->update($request,$assignmentSolutionId);
        try {
            return $this->apiResponse(AssignmentSolutionResource::make($assignmentSolutionEvaluation), __('response/response_message.updated_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignmentSolutionServices $assignmentSolutionServices, $assignmentId)
    {
$assignmentSolution=$assignmentSolutionServices->destroy($assignmentId);
        try {

            return $this->apiResponse(AssignmentSolutionResource::make($assignmentSolution), __('response/response_message.deleted_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
