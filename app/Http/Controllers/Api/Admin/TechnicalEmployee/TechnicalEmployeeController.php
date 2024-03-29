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
use App\Services\adminServices\employeeControl\CreateEmployeeServices;
use App\Services\adminServices\TechnicalEmployeeServices\TechnicalEmployeeServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TechnicalEmployeeController extends Controller
{
    //
    use GeneralTrait;
    public function store(CreateTechnicalEmployeeRequest $request,TechnicalEmployeeServices $technicalEmployeeServices)
    {
        // try {
            $employee=$technicalEmployeeServices->store($request);
        // dd($employee->user);

            return $this->apiResponse((TechnicalEmployeeResource::make($employee)),__('response/response_message.created_success'),200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }
    public function index(TechnicalEmployeeServices $technicalEmployeeServices){
        $technicalEmployee = $technicalEmployeeServices->index();
        try {
            return $this->apiResponse(TechnicalEmployeeCollection::make($technicalEmployee), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function update($id,TechnicalEmployeeServices $technicalEmployeeServices,TechnicalEmployeeUpdateRequest $request){
        // return $id;

        $user=$technicalEmployeeServices->update($request,$id);
        try {
            return $this->apiResponse((TechnicalEmployeeResource::make($user)),__('response/response_message.updated_success'),200);
        }  catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function show($id,TechnicalEmployeeServices $technicalEmployeeServices){
        $user=$technicalEmployeeServices->show($id);
        try {
            return $this->apiResponse((new TechnicalEmployeeResource($user)),__('response/response_message.data_retrieved'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function destroy($id,TechnicalEmployeeServices $technicalEmployeeServices){
        $user=$technicalEmployeeServices->destroy($id);
        try {
            return $this->apiResponse((TechnicalEmployeeResource::make($user)),__('response/response_message.deleted_success'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
