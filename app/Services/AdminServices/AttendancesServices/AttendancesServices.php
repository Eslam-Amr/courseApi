<?php
// namespace App\Services;
namespace App\Services\AdminServices\AttendancesServices;

use App\Http\Requests\AttendancesRequest;
use App\Http\Requests\AttendancesUpdateRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Attendances;
use App\Models\Category;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class AttendancesServices
{
    use GeneralTrait;
public function index(){
    return Attendances::orderBy('session_id')->paginate();
}
    public function store(AttendancesRequest $request)
    {

        $attendances = Attendances::create($request->validated());
        return $attendances;
    }

    public function destroy($id)
    {
        $attendances = Attendances::findOrFail($id);
        $attendances->delete();
        return $attendances;
    }
        public function show($attendancesId){
            return Attendances::findOrFail($attendancesId);
        }
        public function showForSession($sessionId){
            return Attendances::where('session_id',$sessionId)->paginate();
        }
        public function showForUser($userId){
            return Attendances::where('user_id',$userId)->orderBy('session_id')->paginate();
        }
            public function update(AttendancesUpdateRequest $request, $id)
            {
                $attendances = Attendances::findOrFail($id);
                $attendances->update($request->validated());
                return $attendances;
            }
}

