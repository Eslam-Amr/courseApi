<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Empolyee;
use App\Models\User;
use App\Services\adminServices\employeeControl\CreateEmployeeServices;
use App\Traits\GeneralTrait;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeController extends Controller
{
    use GeneralTrait;
    //
    public function create(CreateEmployeeRequest $request,CreateEmployeeServices $createEmployeeServices)
    {
        // return $request['region']['city'];
        // dd(auth()->user());
        // return (new CreateEmployeeServices)->create($request);
        try {
            // $user=Helper::createEmployee($request);
            $user=$createEmployeeServices->create($request);
            // return response()->json([
            //     'status' => true,
            //     'message' => 'employee Created Successfully',
            // ], 200);
            return $this->apiResponse((new EmployeeResource($user)),'successfully',200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
