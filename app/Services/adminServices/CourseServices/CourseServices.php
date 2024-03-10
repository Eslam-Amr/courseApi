<?php
// namespace App\Services;
namespace App\Services\adminServices\CourseServices;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
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

class CourseServices
{
    use GeneralTrait;

    public function store(CourseCreateRequest $request)
    {
        //
        $course=Helper::createCourse($request);
        // Helper::createCourseCategory($request['category'],$course->id);
        $course->categories()->syncWithoutDetaching($request['category']['id']);
        return $course;
    }
    public function show($id){
        return Course::with('rates.user', 'categories')->findOrFail($id);
    }
    public function index(){
        return Course::paginate();
    }
}
