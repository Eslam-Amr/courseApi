<?php

namespace App\Http\Controllers\Api\Admin\TechnicalEmployee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateTechnicalEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\TechnicalEmployeeResource;
use App\Services\adminServices\employeeControl\CreateEmployeeServices;
use App\Services\adminServices\TechnicalEmployeeServices\TechnicalEmployeeServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TechnicalEmployeeController extends Controller
{
    //
    use GeneralTrait;
    public function create(CreateTechnicalEmployeeRequest $request,TechnicalEmployeeServices $technicalEmployeeServices)
    {
        // return $request['region']['city'];
        // dd(auth()->user());
        // return (new CreateEmployeeServices)->create($request);
        try {
            // $user=Helper::createEmployee($request);
            $user=$technicalEmployeeServices->create($request);
            // return response()->json([
            //     'status' => true,
            //     'message' => 'employee Created Successfully',
            // ], 200);
            return $this->apiResponse((new TechnicalEmployeeResource($user)),'successfully',200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
