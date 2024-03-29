<?php
// namespace App\Services;
namespace App\Services\adminServices\employeeControl;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeeServices
{
    use GeneralTrait;

    public function store(CreateEmployeeRequest $request)
    {
        // try {
            $user=Helper::createEmployee($request);
            // return response()->json([
            //     'status' => true,
            //     'message' => 'employee Created Successfully',
            //     'token' => $user->createToken("API TOKEN")->plainTextToken
            // ], 200);
            // $role=Role::where('name','')
            return $user;
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }

    }
    public function index(){
        return Empolyee::paginate();
    }
    public function show($id)
    {
        return Empolyee::findOrFail($id);
    }
    public function destroy($id){
        $employee= Empolyee::findOrFail($id);
$employee->delete();
return $employee;
    }
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $emloyee = Empolyee::findOrFail($id);
        $emloyeeUser = User::findOrFail($emloyee->user_id);
        $emloyeeUser->update([
            'name' => $request->name == null ? $emloyeeUser->name : $request->name,
            'email' => $request->email == null ? $emloyeeUser->email : $request->email,
            'password' => $request->password == null ? $emloyeeUser->password : $request->password,
            'region_id' => $request->regionId == null ? $emloyeeUser->regionId : $request->regionId,
        ]);
        $emloyee->update([

            'role' => $request->role == null ? $emloyee->role : $request->role,
            'salary' => $request->salary == null ? $emloyee->salary : $request->salary,
            'working_hour'=> $request->working_hour == null ? $emloyee->working_hour : $request->working_hour,
            'working_place'=> $request->working_place == null ? $emloyee->working_place : $request->working_place,

        ]);
        return $emloyee;
    }
}
/*


    public function store(CreateTechnicalEmployeeRequest $request)
    {
        // try {
        $user = Helper::createTechnicalEmployee($request);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'employee Created Successfully',
        //     'token' => $user->createToken("API TOKEN")->plainTextToken
        // ], 200);
        return $user;
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

*/
