<?php

namespace App\Http\Controllers\APi\Admin\Session;

use App\Http\Controllers\Controller;
use App\Http\Requests\SessionRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Http\Resources\SessionCollection;
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
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:session-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:session-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:session-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:session-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:session-show,show'
        ])->only(['show']);
    }
    public function index(SessionServices $sessionServices)
    {
        $sessions = $sessionServices->index();
        try {

            return $this->apiResponse(SessionCollection::make($sessions), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request, SessionServices $sessionServices)
    {
        // return $request;
$session=$sessionServices->store($request);
        try {

            return $this->apiResponse(SessionResource::make($session),__('response/response_message.created_success'), 200);
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
        try {
            return $this->apiResponse(SessionResource::make($session),__('response/response_message.data_retrieved'), 200);
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
        $session=$sessionServices->update($request, $sessionId);
        try {

            return $this->apiResponse(SessionResource::make($session), __('response/response_message.updated_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sessionId,SessionServices $sessionServices)
    {

        $session=$sessionServices->destroy($sessionId);
        try {

            return $this->apiResponse(SessionResource::make($session), __("response/response_message.deleted_success"), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //

    }
}
