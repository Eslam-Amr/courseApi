<?php

namespace App\Http\Controllers\APi\Admin\Group;

use App\Actions\TechnicalEmployeeGroupActions\TechnicalEmployeeGroupAction;
use App\Actions\TechnicalEmployeeGroupActions\TechnicalEmployeeGroupUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupTechnicalEmployeeRequest;
use App\Http\Requests\GroupTechnicalEmployeeUpdateRequest;
use App\Http\Resources\TechnicalEmployeeGroupCollection;
use App\Http\Resources\TechnicalEmployeeGroupResource;
use App\Http\Resources\TechnicalEmployeeResource;
use App\Models\GroupTechnicalEmployee;
use App\Models\TechnicalEmployee;
use App\Services\adminServices\TechnicalEmployeeServices\TechnicalEmployeeGroupServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GroupTechnicalEmployeeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-technical-employee-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:group-technical-employee-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:group-technical-employee-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-technical-employee-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:group-technical-employee-show,show'
        ])->only(['show']);
    }
    public function index(TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {

        $technicalEmployeeGroup = $technicalEmployeeGroupServices->index();
        // dd($technicalEmployeeGroup);
        /*          "id" => 17
          "technical_employee_id" => 8
          "group_id" => 22
          "created_at" => null
          "updated_at" => null */
        return $this->apiResponse((TechnicalEmployeeGroupCollection::make($technicalEmployeeGroup)), __('response/response_message.data_retrieved'), 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupTechnicalEmployeeRequest $request, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices, TechnicalEmployeeGroupAction $technicalEmployeeGroupAction)
    {
        $ifExists = $technicalEmployeeGroupAction->handle($request);
        if ($ifExists==1)
            return $this->apiResponse('', __('response/response_message.already_exist'), 200);
            // return $this->apiResponse('null', "alredy exists", 200);
        if ($ifExists==2)
            // return $this->apiResponse('null', "there is employee alredy exists in this postion", 200);
            return $this->apiResponse('', __('response/response_message.there_is_alredy_employee_exist'), 200);
        $employee = $technicalEmployeeGroupServices->store($request);
        // dd(GroupTechnicalEmployee::latest()->get()->last());
        return $this->apiResponse((TechnicalEmployeeGroupResource::make($employee,$request->group_id)), __('response/response_message.created_success'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {
        //
        $technicalEmployeeGroup = $technicalEmployeeGroupServices->show($id);
        try {
            return $this->apiResponse(TechnicalEmployeeGroupResource::make($technicalEmployeeGroup), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupTechnicalEmployeeUpdateRequest $request, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices, $id,TechnicalEmployeeGroupUpdateAction $technicalEmployeeGroupAction)
    {
        $ifExists = $technicalEmployeeGroupAction->handle($request,$id);
        if ($ifExists==1)
        return $this->apiResponse('', __('response/response_message.already_exist'), 200);
        if ($ifExists==2)
        return $this->apiResponse('', __('response/response_message.there_is_alredy_employee_exist'), 200);
    $technicalEmployeeGroup = $technicalEmployeeGroupServices->update($request, $id);
    if($technicalEmployeeGroup==null)
    return $this->apiResponse('', __('response/response_message.cant_update'), 200);
// return response()->json(['message'=>'cant update']);
        try {
            return $this->apiResponse((TechnicalEmployeeGroupResource::make($technicalEmployeeGroup)), __('response/response_message.updated_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {
        $employee=$technicalEmployeeGroupServices->destroy($id);
        return $this->apiResponse(TechnicalEmployeeGroupResource::make($employee), __('response/response_message.deleted_success'), 200);
    }
}
