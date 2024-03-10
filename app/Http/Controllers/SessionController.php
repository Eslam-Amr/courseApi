<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Http\Resources\SessionResource;
use App\Models\Group;
use App\Models\Session;
use App\Services\AdminServices\SessionServices\SessionServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SessionServices $sessionServices)
    {
        $sessions = $sessionServices->index();
        try {

            return $this->apiResponse($sessions, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request, $groupId, SessionServices $sessionServices)
    {
        //
        // $group=Group::find($groupId);
        // if(!$group)
        // return $this->returnError(404, 'Group not found');
        //code...
        try {

            return $this->apiResponse($sessionServices->store($request, $groupId), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($sessionId,SessionServices $sessionServices)
    {
        $session=$sessionServices->show($sessionId);
        // return $session;
        // return $session->group->course;
        try {

            return $this->apiResponse((new SessionResource($session)), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(SessionUpdateRequest $request, $sessionId, SessionServices $sessionServices)
    {
        try {

            return $this->apiResponse($sessionServices->update($request, $sessionId), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sessionId,SessionServices $sessionServices)
    {
        try {

            return $this->apiResponse($sessionServices->destroy($sessionId), 'deleted successfuly', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //

    }
}
