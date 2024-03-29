<?php

namespace App\Http\Controllers\Api\Admin\TechnicalEmployee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateTechnicalEmployeeRequest;
use App\Http\Requests\TechnicalEmployeeUpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\TechnicalEmployeeCollection;
use App\Http\Resources\TechnicalEmployeeResource;
use App\Models\TechnicalEmployee;
use App\Models\User;
use App\Services\adminServices\employeeControl\CreateEmployeeServices;
use App\Services\adminServices\TechnicalEmployeeServices\TechnicalEmployeeServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TechnicalEmployeeController extends Controller
{
    //
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:technical-employee-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:technical-employee-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:technical-employee-store,store'
        ])->only(['store']);
    }
    public function store(CreateTechnicalEmployeeRequest $request, TechnicalEmployeeServices $technicalEmployeeServices)
    {
        $employee = $technicalEmployeeServices->store($request);
        return $this->apiResponse((TechnicalEmployeeResource::make($employee)), __('response/response_message.created_success'), 200);
    }
    public function index(TechnicalEmployeeServices $technicalEmployeeServices)
    {
        $technicalEmployee = $technicalEmployeeServices->index();
        try {
            return $this->apiResponse(TechnicalEmployeeCollection::make($technicalEmployee), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function update($id, TechnicalEmployeeServices $technicalEmployeeServices, TechnicalEmployeeUpdateRequest $request)
    {
        // return $id;

        $user = $technicalEmployeeServices->update($request, $id);
        try {
            return $this->apiResponse((TechnicalEmployeeResource::make($user)), __('response/response_message.updated_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function show($id, TechnicalEmployeeServices $technicalEmployeeServices)
    {
        $user = $technicalEmployeeServices->show($id);
        try {
            return $this->apiResponse((new TechnicalEmployeeResource($user)), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function destroy($id, TechnicalEmployeeServices $technicalEmployeeServices)
    {
        $user = $technicalEmployeeServices->destroy($id);
        try {
            return $this->apiResponse((TechnicalEmployeeResource::make($user)), __('response/response_message.deleted_success'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
