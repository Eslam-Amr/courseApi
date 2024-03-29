<?php
// namespace App\Services;
namespace App\Services\adminServices\TechnicalEmployeeServices;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateTechnicalEmployeeRequest;
use App\Http\Requests\TechnicalEmployeeUpdateRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\TechnicalEmployee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TechnicalEmployeeServices
{
    use GeneralTrait;

    public function store(CreateTechnicalEmployeeRequest $request)
    {
        // try {
        $employee = Helper::createTechnicalEmployee($request);
        $user=User::find($employee->user_id);
        if($request->role=='mentor'){
            $role=Role::where('name','mentor')->first();
            $user->assignRole($role);
        }
        else if($request->role=='instractor'){
            $role=Role::where('name','instractor')->first();
            $user->assignRole($role);
        }
        // return response()->json([
        //     'status' => true,
        //     'message' => 'employee Created Successfully',
        //     'token' => $user->createToken("API TOKEN")->plainTextToken
        // ], 200);
        return $employee;
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }

    }
    public function index()
    {
        return TechnicalEmployee::paginate();
    }
    public function update(TechnicalEmployeeUpdateRequest $request, $id)
    {
        $technicalEmloyee = TechnicalEmployee::findOrFail($id);
        $technicalEmloyeeUser = User::findOrFail($technicalEmloyee->user_id);
        $technicalEmloyeeUser->update([
            'name' => $request->name == null ? $technicalEmloyeeUser->name : $request->name,
            'email' => $request->email == null ? $technicalEmloyeeUser->email : $request->email,
            'password' => $request->password == null ? $technicalEmloyeeUser->password : $request->password,
            'region_id' => $request->regionId == null ? $technicalEmloyeeUser->regionId : $request->regionId,
        ]);
        if($request->role=='mentor'){
            $role=Role::where('name','mentor')->first();
            $technicalEmloyeeUser->removeRole($technicalEmloyeeUser->roles()->first());
            $technicalEmloyeeUser->assignRole($role);
        }
        else if($request->role=='instractor'){
            $role=Role::where('name','instractor')->first();
            $technicalEmloyeeUser->removeRole($technicalEmloyeeUser->roles()->first());
            $technicalEmloyeeUser->assignRole($role);
        }
        $technicalEmloyee->update([

            'role' => $request->role == null ? $technicalEmloyee->role : $request->role,
            'salary' => $request->salary == null ? $technicalEmloyee->salary : $request->salary,
            'number_of_group' => $request->number_of_group == null ? $technicalEmloyee->number_of_group : $request->number_of_group,

        ]);
        return $technicalEmloyee;
    }
    public function show($id)
    {
        return TechnicalEmployee::findOrFail($id);
    }
    public function destroy($id){
        $employee= TechnicalEmployee::findOrFail($id);
$employee->delete();
return $employee;
    }
}
