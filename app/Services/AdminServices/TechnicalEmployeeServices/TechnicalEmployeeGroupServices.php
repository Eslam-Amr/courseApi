<?php
// namespace App\Services;
namespace App\Services\adminServices\TechnicalEmployeeServices;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateTechnicalEmployeeRequest;
use App\Http\Requests\GroupTechnicalEmployeeRequest;
use App\Http\Requests\GroupTechnicalEmployeeUpdateRequest;
use App\Http\Requests\TechnicalEmployeeUpdateRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\GroupTechnicalEmployee;
use App\Models\TechnicalEmployee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class TechnicalEmployeeGroupServices
{
    use GeneralTrait;

    public function store(GroupTechnicalEmployeeRequest $request)
    {
        $employee = TechnicalEmployee::findOrFail($request->technical_employee_id);

        $employee->group()->syncWithoutDetaching($request->group_id);
        $employee->update(['number_of_group' => ++$employee->number_of_group]);
        return $employee;
    }
    public function index()
    {
        return GroupTechnicalEmployee::orderBy('group_id')
            ->paginate();
    }

    public function update(GroupTechnicalEmployeeUpdateRequest $request, $id)
    {

        $groupTechnicalEmployee = GroupTechnicalEmployee::findOrFail($id);
        $groupTechnicalEmployee->technicalEmployee->decrement('number_of_group');
        $groupTechnicalEmployee->update($request->validated());
        TechnicalEmployee::findOrFail($request->technical_employee_id)->increment('number_of_group');
        return $groupTechnicalEmployee;
    }

    public function show($id)
    {
        return GroupTechnicalEmployee::findOrFail($id);
    }
    public function destroy($id)
    {
        $technicalEmployeeGroup = GroupTechnicalEmployee::findOrFail($id);
        $employee = TechnicalEmployee::findOrFail($technicalEmployeeGroup->technical_employee_id);
        if ($employee->number_of_group > 0) {
            $employee->update(['number_of_group' => --$employee->number_of_group]);
            $technicalEmployeeGroup->delete();
        }

        return $employee;
    }
}
