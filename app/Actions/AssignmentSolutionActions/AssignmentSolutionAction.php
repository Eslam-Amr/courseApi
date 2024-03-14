<?php

namespace App\Actions\AssignmentSolutionActions;

use App\Models\Assignment;
use App\Models\AssignmentSolution;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Helper;

class AssignmentSolutionAction
{
    public function handle($assignmentId,$userId)
    {
        $checkIfExists = AssignmentSolution::where('user_id', $userId)->where('assignment_id', $assignmentId)->first();
        if ($checkIfExists)
            return 1;
        $assignment = Assignment::select('start_date', 'dead_line')->findOrFail($assignmentId);
        $currentDate = Carbon::now()->format('Y-m-d');
            if ($assignment['start_date'] > $currentDate || $assignment['dead_line'] < $currentDate) {
                
                return 2;
            }
        return 0;
    }
}
