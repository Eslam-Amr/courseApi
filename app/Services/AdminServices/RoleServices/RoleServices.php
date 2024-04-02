<?php
// namespace App\Services;
namespace App\Services\AdminServices\RoleServices;

use App\Http\Requests\RegionRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Region;

use App\Traits\GeneralTrait;
use Spatie\Permission\Models\Role;

class RoleServices
{
    use GeneralTrait;

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());
        $permissions = $request->permission;
        $role->syncPermissions($permissions);
        return $role;
    }
    public function show($id)
    {
        return Role::findOrFail($id);
    }
    public function index()
    {
        return Role::paginate();
    }

    public function update($id, $request)
    {
        $role=Role::findOrFail($id);
        $role->update($request->validated());
        $permissions = $request->permission;

        $role->syncPermissions($permissions);
        return $role;
    }
    public function destroy($id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        return $role;
    }
}
