<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\AdminServices\RoleServices\RoleServices;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function store(RoleRequest $request, RoleServices $roleServices)
    {
        return $request->all();
    }
}
