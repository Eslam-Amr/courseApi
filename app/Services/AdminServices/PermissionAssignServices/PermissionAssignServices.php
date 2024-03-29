<?php
// namespace App\Services;
namespace App\Services\AdminServices\PermissionAssignServices;

use App\Http\Requests\PermissionAssignRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\RegionUpdateRequest;

use App\Models\Region;

use App\Traits\GeneralTrait;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAssignServices
{
    use GeneralTrait;
    public function store(PermissionAssignRequest $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);
        $role->givePermissionTo($permission);
        // $role->revokePermissionTo($permission);
        return  $role;
        // dd($role,$permission);


    }
    public function destroy(PermissionAssignRequest $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);
        $role->revokePermissionTo($permission);
        return  $role;
    }

}
