<?php

namespace App\Actions\GroupActions;

use App\Models\Group;
use App\Models\Session;
use DateTime;
use Helper;

class GroupAction
{
    public function handle(Group $group, $request)
    {
        $numberOfWeeks = Helper::getDiffrenceInWeek($request);
        $startDate = new DateTime($request['start_date']);
        for ($i = 0; $i < $numberOfWeeks; $i++) {
            Session::create([
                'date' => $startDate,
                'group_id' => $group['id']
            ]);
            $startDate->modify("7 days");
        }
    }
}


// $date = $group['start_date'];

// // Extracting year, month, and day
// $year = date('Y', strtotime($date));
// $month = date('m', strtotime($date));
// $day = date('d', strtotime($date));

// // Getting the week number
// $week = date('W', strtotime($date));

// dd($year,
// $month,
// $day,
// $week );
