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
use App\Models\TechnicalEmployee;
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

        $group = Group::create(array_merge($request->validated(), ['registered_student' => 0]));
        // $session=(new GroupAction)->handle($Group);
        if (isset($request['instractor_id'])) {
            $instractor = TechnicalEmployee::findOrFail($request->instractor_id);
            $instractor->group()->syncWithoutDetaching($group->id);
            $instractor->update(['number_of_group' => ++$instractor->number_of_group]);
        }
        if (isset($request['mentor_id'])) {
            $mentor = TechnicalEmployee::findOrFail($request->mentor_id);
            $mentor->group()->syncWithoutDetaching($group->id);
            $mentor->update(['number_of_group' => ++$mentor->number_of_group]);
        }
        (new GroupAction)->handle($group, $request);
        return $group;

    }
    public function show($groupId)
    {
        $group = Group::findOrFail($groupId);
        return $group;
    }
    public function destroy($groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->delete();
        return $group;
    }
    public function index(){
        return Group::paginate();
    }
    public function update($request,$id){
        $group = Group::findOrFail($id);
        $group->update($request->validated());
        return $group;
    }
}
