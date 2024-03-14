<?php

namespace App\Actions\AttendancesActions;

use App\Models\Attendances;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Session;
use App\Models\User;
use DateTime;
use Helper;

class AttendancesAction
{
    public function handle($sessionId,$userId)
    {
        $checkIfExists = Attendances::where('user_id', $userId)->where('session_id', $sessionId)->first();
        if ($checkIfExists)
            return 1;
        return 0;
    }
}
