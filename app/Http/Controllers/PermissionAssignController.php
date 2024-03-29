<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionAssignRequest;
use App\Services\AdminServices\PermissionAssignServices\PermissionAssignServices;
use Illuminate\Http\Request;

class PermissionAssignController extends Controller
{
    public function store(PermissionAssignRequest $request, PermissionAssignServices $permissionAssignServices)
    {
        $role = $permissionAssignServices->store($request);
        return $role;
    }
    public function destroy(PermissionAssignRequest $request, PermissionAssignServices $permissionAssignServices)
    {
        $role = $permissionAssignServices->destroy($request);
        return $role;
    }

}
