<?php
// namespace App\Services;
namespace App\Services\AdminServices\GroupServices;

use App\Actions\GroupActions\GroupAction;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\Group;
use App\Models\Region;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class GroupServices
{
    use GeneralTrait;

    public function store(GroupRequest $request)
    {
        // try {

            $Group = Group::create(array_merge($request->validated(), ['registered_student' => 0]));
            // $session=(new GroupAction)->handle($Group);
            (new GroupAction)->handle($Group,$request);
            return $Group;
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }
    public function show($groupId){
        $group=Group::findOrFail($groupId);
        return $group;
    }
    public function destroy($groupId){
        $group=Group::findOrFail($groupId);
        $group->delete();
        return $group;
    }

}
