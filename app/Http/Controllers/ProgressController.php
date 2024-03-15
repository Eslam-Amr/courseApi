<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\Group;
use App\Models\Progress;
use App\Models\Session;
use Helper;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProgressController extends Controller
{
    /**
     $user_id = auth()->user()->id;

     $group = Group::findOrFail($groupId);

     $averageEvaluation = $group->assignment()
         ->whereHas('assignmentSolution', function ($query) use ($user_id) {
             $query->where('user_id', $user_id);
         })
         ->with(['assignmentSolution' => function ($query) use ($user_id) {
             $query->where('user_id', $user_id);
         }])
         ->get()
         ->filter(function ($assignment) {
             return $assignment->assignmentSolution->isNotEmpty(); // Filter out assignments with no solutions
         })
         ->map(function ($assignment) {
             return $assignment->assignmentSolution->avg('evaluation');
         });
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // $user_id = auth()->user()->id;

    // $group = Group::findOrFail($groupId);

    // $averageEvaluation = $group->assignment()
    //     ->whereHas('assignmentSolution', function ($query) use ($user_id) {
    //         $query->where('user_id', $user_id);
    //     })
    //     ->with(['assignmentSolution' => function ($query) use ($user_id) {
    //         $query->where('user_id', $user_id);
    //     }])
    //     ->get()
    //     ->map(function ($assignment) {
    //         return $assignment->assignmentSolution->avg('evaluation');
    //     })
    //     ->avg();
    // $user_id = auth()->user()->id;
//     public function show($groupId)
//     {
//         // $user_id = auth()->user()->id;

//         // $group = Group::findOrFail($groupId);

//         // $totalEvaluation = $group->assignment()
//         //     ->whereHas('assignmentSolution', function ($query) use ($user_id) {
//         //         $query->where('user_id', $user_id);
//         //     })
//         //     ->with(['assignmentSolution' => function ($query) use ($user_id) {
//         //         $query->where('user_id', $user_id);
//         //     }])
//         //     ->get()
//         //     ->filter(function ($assignment) {
//         //         return $assignment->assignmentSolution->isNotEmpty(); // Filter out assignments with no solutions
//         //     })
//         //     ->map(function ($assignment) {
//         //         return $assignment->assignmentSolution->sum('evaluation');
//         //     })
//         //     ->sum();

//         // return $totalEvaluation;
//         $user_id = auth()->user()->id;

//         $group = Group::findOrFail($groupId);

//         $evaluationValues = $group->assignment()
//             ->whereHas('assignmentSolution', function ($query) use ($user_id) {
//                 $query->where('user_id', $user_id);
//             })
//             ->with(['assignmentSolution' => function ($query) use ($user_id) {
//                 $query->where('user_id', $user_id);
//             }])
//             ->get()
//             ->filter(function ($assignment) {
//                 return $assignment->assignmentSolution->isNotEmpty(); // Filter out assignments with no solutions
//             })
//             ->flatMap(function ($assignment) {
//                 return $assignment->assignmentSolution->pluck('evaluation');
//             })
//             ->toArray();

//         return $evaluationValues;

//         return $averageEvaluation;

// // $averageEvaluation = Attendances::whereHas('session.group', function ($query) use ($groupId) {
// //         $query->where('id', $groupId);
// //     })
// //     ->where('user_id', $user_id)
// //     ->avg('evaluation');

// dd($averageEvaluation);
//         //
//         // return Session::findOrFail(1)->assignment;
//         // return (Group::findOrFail($groupId)->session);
// //         $sessionsWithAttendances = Group::findOrFail($groupId)->session()->with('attendances')->get();
// // return $sessionsWithAttendances;
// $user_id = auth()->user()->id;

// // $sessionsWithAttendances = Group::findOrFail($groupId)
// //     // ->session()
// //     ->with(['attendances' => function ($query) use ($user_id) {
// //         $query->where('user_id', $user_id);
// //     }])
// //     ->get();
// // return $sessionsWithAttendances[0]['attendances'];
// // $attendances = $sessionsWithAttendances;
// // $totalEvaluation = 0;

// // foreach ($attendances as $attendance) {
// //     dd($attendance);
// //     $totalEvaluation += $attendance->evaluation;
// // }

// // return $totalEvaluation;
// // $user_id = auth()->user()->id;
// // $averageEvaluations = [];

// // $sessionsWithAttendances = Group::findOrFail($groupId)->session()->with('attendances')->get();

// // foreach ($sessionsWithAttendances as $session) {
// //     $attendances = $session->attendances()->where('user_id', $user_id)->get();

// //     $totalEvaluation = $attendances->sum('evaluation');
// //     $count = $attendances->count();
// //     $averageEvaluation = $count > 0 ? $totalEvaluation / $count : 0;

// //     $averageEvaluations[$session->id] = $averageEvaluation;
// // }

// // return $averageEvaluations;


//     $user_id = auth()->user()->id;

// $group = Group::findOrFail($groupId);

// $averageEvaluation = $group->assignment()
//     ->whereHas('assignmentSolution', function ($query) use ($user_id) {
//         $query->where('user_id', $user_id);
//     })
//     ->with(['assignmentSolution' => function ($query) use ($user_id) {
//         $query->where('user_id', $user_id);
//     }])
//     ->get()
//     ->map(function ($assignment) {
//         return $assignment->assignmentSolution->avg('evaluation');
//     })
//     ->avg();

// // dd($averageEvaluation);



// // dd($assignmentSolutions);

// $user_id = auth()->user()->id;

// $averageEvaluation = Attendances::whereHas('sessions.group', function ($query) use ($groupId) {
//         $query->where('id', $groupId);
//     })
//     ->where('user_id', $user_id)
//     ->avg('evaluation');

// dd($averageEvaluation);

// // $totalEvaluation = 0;

// // foreach ($sessionsWithAttendances as $session) {
// //     if ($session->attendances) {
// //         foreach ($session->attendances as $attendance) {
// //             $totalEvaluation += $attendance->evaluation;
// //         }
// //     }
// // }

// // dd($totalEvaluation); // Check the value of $totalEvaluation before returning
// // return $totalEvaluation;

//     // $totalEvaluation = 0;

//     // foreach ($sessionsWithAttendances as $session) {
//     //     if ($session->attendances) {
//     //         foreach ($session->attendances as $attendance) {
//     //             $totalEvaluation += $attendance->evaluation;
//     //         }
//     //     }
//     // }

//     // return $totalEvaluation;
// // return $sessionsWithAttendances;

// // $attendances = Attendances::join('sessions', 'attendances.session_id', '=', 'sessions.id')
// // ->select('attendances.*')
// // ->where('sessions.id', '=', (Group::findOrFail($groupId)->session)[0]->id)
// // ->get();

// // $group = Group::findOrFail($groupId);
// // $sessionIds = $group->session->pluck('id'); // Get session IDs associated with the group

// // $attendances = Attendances::whereIn('session_id', $sessionIds)->get();
// //         // return Attendances::findOrFail(1)->session;
// // return $attendances;
// //         $sessions = Session::with('attendances')->get();
// // return $sessions;
// }
public function show($groupId){

    $AVGattendance=Helper::attendanceAvg($groupId);

}
/**
 * Show the form for editing the specified resource.
 */
public function edit(Progress $progress)
{
    //
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Progress $progress)
{
    //
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Progress $progress)
{
    //
}
}

// $sessionsWithAttendances = Group::findOrFail($groupId)->session()->with('attendances')->get();
// return $sessionsWithAttendances;
