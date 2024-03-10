<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
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
    public function store(CreateEmployeeRequest $request,EmployeeServices $createEmployeeServices)
    {
        try {
        $user=$createEmployeeServices->store($request);

            return $this->apiResponse((new EmployeeResource($user)),'successfully',200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function index(EmployeeServices $employeeServices){
        // $employee = $employeeServices->index();

        // return $this->apiResponse($employee,'successfully',200);


        $employee = $employeeServices->index();
        try {
            return $this->apiResponse($employee, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
        public function show($id,EmployeeServices $employeeServices){
        $user=$employeeServices->show($id);
        try {
            return $this->apiResponse($user,'success',200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function destroy($id,EmployeeServices $employeeServices){
                $user=$employeeServices->destroy($id);
                try {
                    return $this->apiResponse($user,'success',200);
                } catch (\Exception $ex) {
                    return $this->returnError($ex->getCode(), $ex->getMessage());
                }
            }
    public function update($id,EmployeeServices $employeeServices,EmployeeUpdateRequest $request){
        // return $id;

        $user=$employeeServices->update($request,$id);
        try {
            return $this->apiResponse((new EmployeeResource($user)),'successfully',200);
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
