<?php

namespace App\Actions\TechnicalEmployeeGroupActions;

use App\Models\Group;
use App\Models\GroupTechnicalEmployee;
use App\Models\GroupUser;
use App\Models\Session;
use App\Models\TechnicalEmployee;
use App\Models\User;
use DateTime;
use Helper;

class TechnicalEmployeeGroupAction
{
    public function handle($request,$groupId=null)
{
    if ($groupId === null) {
        $groupId = $request->group_id;
    }
    $groupTechnicalEmployees = GroupTechnicalEmployee::where('group_id', $groupId)->get();

    foreach ($groupTechnicalEmployees as $groupTechnicalEmployee) {
        if ($groupTechnicalEmployee->technicalEmployee->id == $request->technical_employee_id) {
            return 1;
        }
        $role = TechnicalEmployee::select('role')->findOrFail($request->technical_employee_id)->role;
        if ($groupTechnicalEmployee->technicalEmployee->role == $role) {
            return 2;
        }
    }

    return 0;
}
}
// public function handle($request)
// {
//     $checkIfExists = GroupTechnicalEmployee::where('group_id', $request->group_id)->get();
//     // dd($checkIfExists);
//     for ($i = 0; $i < 2; ++$i) {
//         if ($checkIfExists[$i]->technicalEmployee->id == $request->technical_employee_id)
//             return 1;
//         if ($checkIfExists[$i]->technicalEmployee->role == TechnicalEmployee::select('role')->findOrFail($request->technical_employee_id)['role']);
//         return 2;
//     }
//     return 0;
// }
// public function handle($request)
// {
//     $checkIfExists = GroupTechnicalEmployee::where('technical_employee_id', $request->technical_employee_id)->where('group_id', $request->group_id)->first();
//     if ($checkIfExists)
//         return 1;
//     return 0;
// }
