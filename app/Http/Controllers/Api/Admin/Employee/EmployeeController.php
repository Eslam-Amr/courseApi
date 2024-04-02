<?php

namespace App\Http\Controllers\Api\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Empolyee;
use App\Models\User;
use App\Services\adminServices\employeeControl\EmployeeServices;
use App\Traits\GeneralTrait;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use GeneralTrait;
    //
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:employee-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:employee-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:employee-store,store'
        ])->only(['store']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:employee-index,index'
        ])->only(['index']);
        $this->middleware([
            'auth:sanctum',
            'check.permission:employee-show,show'
        ])->only(['show']);
    }
    public function store(CreateEmployeeRequest $request,EmployeeServices $createEmployeeServices)
    {
        $employee=$createEmployeeServices->store($request);
        try {

            return $this->apiResponse((EmployeeResource::make($employee)),__('response/response_message.created_success'),200);
        }  catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function index(EmployeeServices $employeeServices){
        // $employee = $employeeServices->index();

        // return $this->apiResponse($employee,'successfully',200);


        $employee = $employeeServices->index();
        try {
            return $this->apiResponse(EmployeeCollection::make($employee), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
        public function show($id,EmployeeServices $employeeServices){
        $employee=$employeeServices->show($id);
        try {
            return $this->apiResponse((EmployeeResource::make($employee)),__('response/response_message.data_retrieved'),200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function destroy($id,EmployeeServices $employeeServices){
                $employee=$employeeServices->destroy($id);
                try {
                    return $this->apiResponse((EmployeeResource::make($employee)),__('response/response_message.deleted_success'),200);
                } catch (\Exception $ex) {
                    return $this->returnError($ex->getCode(), $ex->getMessage());
                }
            }
    public function update($id,EmployeeServices $employeeServices,EmployeeUpdateRequest $request){
        // return $id;

        $employee=$employeeServices->update($request,$id);
        try {
            return $this->apiResponse((EmployeeResource::make($employee)),__('response/response_message.updated_success'),200);
        }  catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}




// public function store(CreateTechnicalEmployeeRequest $request,TechnicalEmployeeServices $technicalEmployeeServices)
//     {
//         try {
//             $user=$technicalEmployeeServices->store($request);
//             return $this->apiResponse((new TechnicalEmployeeResource($user)),'successfully',200);
//         } catch (\Throwable $th) {
//             return response()->json([
//                 'status' => false,
//                 'message' => $th->getMessage()
//             ], 500);
//         }
//     }
//     public function index(TechnicalEmployeeServices $technicalEmployeeServices){
//         $technicalEmployee = $technicalEmployeeServices->index();
//         try {
//             return $this->apiResponse($technicalEmployee, 'success', 200);
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
//     public function update($id,TechnicalEmployeeServices $technicalEmployeeServices,TechnicalEmployeeUpdateRequest $request){
//         // return $id;

//         $user=$technicalEmployeeServices->update($request,$id);
//         try {
//             return $this->apiResponse((new TechnicalEmployeeResource($user)),'successfully',200);
//         }  catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
//     public function show($id,TechnicalEmployeeServices $technicalEmployeeServices){
//         $user=$technicalEmployeeServices->show($id);
//         try {
//             return $this->apiResponse((new TechnicalEmployeeResource($user)),'success',200);
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
//     public function destroy($id,TechnicalEmployeeServices $technicalEmployeeServices){
//         $user=$technicalEmployeeServices->destroy($id);
//         try {
//             return $this->apiResponse((new TechnicalEmployeeResource($user)),'success',200);
//         } catch (\Exception $ex) {
//             return $this->returnError($ex->getCode(), $ex->getMessage());
//         }
//     }
