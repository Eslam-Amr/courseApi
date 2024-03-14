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

class TechnicalEmployeeGroupUpdateAction
{
    public function handle($request, $id)
{
    $groupTechnicalEmployee = GroupTechnicalEmployee::findOrFail($id);
       if ($request->has('technical_employee_id')) {
            if ($groupTechnicalEmployee->technicalEmployee->id == $request->technical_employee_id) {
                return 1;
            }
        }
    return 0;
}

}
