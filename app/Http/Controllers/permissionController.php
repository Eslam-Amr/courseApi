<?php

namespace App\Http\Controllers;

use App\Http\Requests\permissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use App\Services\AdminServices\PermissionServices\PermissionServices;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    public function index(PermissionServices $permissionServices)
    {
        return $permissionServices->index();
    }
    public function show($id,PermissionServices $permissionServices)
    {
        return $permissionServices->show($id);
    }
    public function update($id,PermissionServices $permissionServices,permissionUpdateRequest $request)
    {
        return $permissionServices->update($id,$request);
    }
    public function store(permissionRequest $request, PermissionServices $permissionServices)
    {
        $permission = $permissionServices->store($request);
        return $permission;
    }
    public function destroy($id, PermissionServices $permissionServices)
    {
        $permission = $permissionServices->destroy($id);
        return $permission;
    }
}
