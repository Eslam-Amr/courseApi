<?php

namespace App\Http\Controllers\APi\Admin\PermissionRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Services\AdminServices\RoleServices\RoleServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use GeneralTrait;

    public function store(RoleRequest $request, RoleServices $roleServices)
    {
        $role = $roleServices->store($request);
        return $this->apiResponse(RoleResource::make($role), __("response/response_message.created_success"), 200);
    }
    public function destroy($id, RoleServices $roleServices)
    {
        $role = $roleServices->destroy($id);
        return $this->apiResponse(RoleResource::make($role), __("response/response_message.deleted_success"), 200);
    }

    public function index( RoleServices $roleServices)
    {
        $role = $roleServices->index();
        return $this->apiResponse(RoleCollection::make($role), __("response/response_message.data_retrieved"), 200);
    }
    public function show( $id,RoleServices $roleServices)
    {
        $role = $roleServices->show($id);
        return $this->apiResponse(RoleResource::make($role), __("response/response_message.data_retrieved"), 200);
    }
    public function update(RoleUpdateRequest $request,$id, RoleServices $roleServices)
    {
        $role = $roleServices->update($request,$id);
        return $this->apiResponse(RoleResource::make($role), __("response/response_message.updated_success"), 200);
    }
}
