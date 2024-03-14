<?php

namespace App\Actions\CourseActions;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Session;
use App\Models\User;
use DateTime;
use Helper;

class CourseAction
{
    public function handle($groupId,$userId)
    {
        $checkIfExists = GroupUser::where('user_id', $userId)->where('group_id', $groupId)->first();
        if ($checkIfExists)
            return 1;
        return 0;
    }
}
