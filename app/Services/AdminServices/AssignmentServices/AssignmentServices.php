<?php
// namespace App\Services;
namespace App\Services\AdminServices\AssignmentServices;

use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Assignment;
use App\Models\Category;
use App\Models\Course;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class AssignmentServices
{
    use GeneralTrait;
public function index(){
    return Assignment::paginate();
}
    public function store(AssignmentRequest $request,)
    {
        $assignment = Assignment::create($request->validated());
        return $assignment;
    }
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        return $assignment;
    }
    public function update(AssignmentUpdateRequest $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->update($request->validated());
        return $assignment;
    }
    public function show($assignmentId){
        return Assignment::findOrFail($assignmentId);
    }

}
