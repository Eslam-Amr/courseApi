<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\AssignmentUpdateRequest;
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
    public function index(AssignmentServices $assignmentServices)
    {
        $assignment = $assignmentServices->index();
        try {

            return $this->apiResponse($assignment, 'success', 200);
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

            return $this->apiResponse($assignment, 'success', 200);
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
            return $this->apiResponse($assignment, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(AssignmentUpdateRequest $request, $id, AssignmentServices $assignmentServices)
    {
        try {
            return $this->apiResponse($assignmentServices->update($request, $id), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy($assignmentId, AssignmentServices $assignmentServices)
    {
        try {

            return $this->apiResponse($assignmentServices->destroy($assignmentId), 'deleted successfuly', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //

    }
}
