<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Empolyee;
use App\Models\User;
use App\Services\adminServices\employeeControl\CreateEmployeeServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeController extends Controller
{
    //
    public function create(CreateEmployeeRequest $request)
    {
        return (new CreateEmployeeServices)->create($request);

    }
}
