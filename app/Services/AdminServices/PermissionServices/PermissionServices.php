<?php
// namespace App\Services;
namespace App\Services\AdminServices\PermissionServices;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\permissionUpdateRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\RegionUpdateRequest;

use App\Models\Region;

use App\Traits\GeneralTrait;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionServices
{
    use GeneralTrait;
    public function index()
    {
        return Permission::paginate();
    }
    public function show($id)
    {
        return Permission::findOrFail($id);
    }
    public function update($id,permissionUpdateRequest $request)
    {

        $permission= Permission::findOrFail($id);
        $permission->update($request->validated());
        return $permission;
    }
    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        return  $permission;
    }
    public function destroy($id)
    {

        $permission = Permission::findOrFail($id);
        $permission->delete();
        return $permission;
    }
}
