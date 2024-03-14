<?php
// namespace App\Services;
namespace App\Services\AdminServices\CourseServices;

use App\Http\Requests\RateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
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

class CourseRegistrationAdminServices
{
    use GeneralTrait;
    public function store(Group $group)
    {
        $user = User::find(auth()->user()->id);
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
    public function destroy($groupId)
    {

        $user = auth()->user();
        $session = GroupUser::where('group_id', $groupId)->where('user_id', $user->id)->first();
        $group = Group::findOrFail($groupId);
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
    public function index()
    {
        return auth()->user()->group()->paginate();
    }
    public function show($groupId)
    {

        return GroupUser::where('group_id', $groupId)->where('user_id', auth()->user()->id)->first();
    }
}




