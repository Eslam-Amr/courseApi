<?php
// namespace App\Services;
namespace App\Services\UserServices\AssignmentSolutionServices;

use App\Http\Requests\AssignmentSolutionRequest;
use App\Http\Requests\RateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use App\Models\Assignment;
use App\Models\AssignmentSolution;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssignmentSolutionServices
{
    use GeneralTrait;
    public function store(AssignmentSolutionRequest $request)
    {

        $assignmentSolution = AssignmentSolution::create(array_merge($request->validated(), ['user_id' => auth()->user()->id, 'date' => Carbon::now()->format('Y-m-d')]));
        return $assignmentSolution;
    }
    public function destroy($assignmentId)
    {
        $assignment = AssignmentSolution::findOrFail($assignmentId);
        $assignment->delete();
        return $assignment;
    }
    public function index()
    {

        return AssignmentSolution::where('user_id',auth()->user()->id)->orderBy('group_id')->paginate();
    }
    public function show($assignmentId)
    {

        return AssignmentSolution::findOrFail($assignmentId);
    }
}



// public function index(){
//     return Category::paginate();
// }
//     public function store(CategoryRequest $request)
//     {

//         $category = Category::create($request->validated());
//         return $category;
//     }
//     public function destroy($id)
//     {
//         $category = Category::findOrFail($id);
//         return $category;
//     }
//     public function update(CategoryRequest $request, $id)
//     {
//         $category = Category::findOrFail($id);
//         $category->update($request->validated());
//         return $category;
//     }
//     public function show($categoryId){
//         return Category::findOrFail($categoryId);
//     }
