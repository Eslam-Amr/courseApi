<?php
// namespace App\Services;
namespace App\Services\UserServices\CourseServices;

use App\Http\Requests\RateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use App\Models\Assignment;
use App\Models\Attendances;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Rate;
use App\Models\User;
use App\Models\Wishlist;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseRegistrationServices
{
    use GeneralTrait;
    public function store(Group $group, $userId)
    {
        $user = User::find($userId);
        // $sessions=$group->session;
        // dd($group->id);
        // $assignments=$group->assignment;
        // foreach ($sessions as $session){
        //     $attendances = new Attendances();
        //     $attendances->user_id = $user->id;
        //     $attendances->session_id = $session->id;
        //     $attendances->save();
        // }
        // foreach ($assignments as $assignment){
        //     AssignmentSol::create([
        //         'assignment_id' => $assignment->id,
        //         'user_id' => $user->id,
        //         'file' => '',
        //         'descreption' => '',
        //         'group_id' => $group->id,
        //         'course_id' => $group->course_id,
        //         'start_date' => $group->course_id,
        //         'course_id' => $group->course_id,
        //     ]);
        // }
        DB::beginTransaction();
        try {
            if ($group->registered_student < $group->max_student)
                $group->update(['registered_student' => ++$group->registered_student]);
            $user->group()->syncWithoutDetaching($group->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return $user;
    }
    public function destroy($groupId, $userId)
    {

        $user = User::find($userId);
        $session = GroupUser::where('group_id', $groupId)->where('user_id', $user->id)->first();
        $group = Group::findOrFail($groupId);
        // $startDate = Carbon::parse($group->start_date);
        // $currentDate = Carbon::now();
        // $weeksDifference = $currentDate->diffInWeeks($startDate);
        // if ($weeksDifference < 2) {
        //     return null;
        // }
        if ($session) {
            DB::beginTransaction();
            try {
                $user->group()->detach($groupId);
                if ($group->registered_student > 0)
                    $group->update(['registered_student' => --$group->registered_student]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return $session;
        }
        return null;
    }
    public function index($userId)
    {
        $user = User::find($userId);
        return $user->group()->paginate();
    }
    public function show($groupId, $userId)
    {

        return GroupUser::where('group_id', $groupId)->where('user_id', $userId)->first();
    }
}
