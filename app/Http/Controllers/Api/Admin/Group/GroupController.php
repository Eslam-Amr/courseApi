<?php

namespace App\Http\Controllers\APi\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Services\AdminServices\GroupServices\GroupServices;
use App\Traits\GeneralTrait;
use DateTime;
use Helper;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:group-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:group-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-show,show'
        ])->only(['show']);
    }
    public function index(GroupServices $groupServices)
    {
        //
$group =$groupServices->index();
return $this->apiResponse(GroupCollection::make($group),__('response/response_message.data_retrieved'),200);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request,GroupServices $groupServices)
    {
$group=$groupServices->store($request);
        try {
            return $this->apiResponse(GroupResource::make($group),__('response/response_message.created_success'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($groupId,GroupServices $groupServices)
    {
        $group=$groupServices->show($groupId);
        try {
            return $this->apiResponse(GroupResource::make($group),__("response/response_message.data_retrieved"), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, GroupServices $groupServices,$id)
    {
$group=$groupServices->update($request,$id);
        try {
            return $this->apiResponse(GroupResource::make($group),__('response/response_message.updated_success'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($groupId ,GroupServices $groupServices)
    {
        $group=$groupServices->destroy($groupId);
        try {
            return $this->apiResponse(GroupResource::make($group),__("response/response_message.deleted_success"), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
