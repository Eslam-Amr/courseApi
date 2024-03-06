<?php

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\CreateTechnicalEmployeeRequest;
use App\Models\Category;
use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\Empolyee;
use App\Models\Rate;
use App\Models\Region;
use App\Models\TechnicalEmployee;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Helper
{
    public static function createUser($request, $regionId, $role)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'region_id' => isset($regionId) ? $regionId : null,
            'gender' => $request->gender,
            'image' => isset($request->image) ? $request->image : null,
            'dateOfBirth' => isset($request->dateOfBirth) ? $request->dateOfBirth : null,
            'password' => Hash::make($request->password)
        ]);
        return $user;
    }
    public static function createToken($user)
    {
        //     $token = $user->createToken("API TOKEN")->plainTextToken;
        // return $token;
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
    public static function registerUserVaildation($request)
    {
        // $validateUser = Validator::make($request->all(),
        // [
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );
        return $validateUser;
    }
    public static function loginUserVaildation($request)
    {

        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        return $validateUser;
    }
    public static function createEmployee(CreateEmployeeRequest $request)
    {
        DB::beginTransaction();

        $validateUser = $request->validated();
        if (isset($request['region']))
            $regionId = Helper::getRegionId($request['region']);
        else
            $regionId = null;
        $user = Helper::createUser($request, $regionId, 'employee');
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role' => 'employee',
        //     'gender' => $request->gender,
        //     'password' => Hash::make($request->password)
        // ]);
        Empolyee::create([
            'user_id' => $user->id,
            'salary' => $request->salary,
            'role' => $request->role,
            'working_hour' => $request->working_hour,
            'working_place' => $request->working_place,
        ]);
        DB::commit();
        return $user;
    }
    public static function createTechnicalEmployee(CreateTechnicalEmployeeRequest $request)
    {
        DB::beginTransaction();

        // $validateUser = $request->validated();
        if (isset($request['region']))
            $regionId = Helper::getRegionId($request['region']);
        else
            $regionId = null;
        $user = Helper::createUser($request, $regionId, 'technicalEmployee');
        TechnicalEmployee::create([
            'user_id' => $user->id,
            'salary' => $request->salary,
            'role' => $request->role,
            'number_of_group' => $request->number_of_group,
        ]);
        DB::commit();
        return $user;
    }
    public static function editProfile(Request $request, $data, $regionId)
    {
        if (!is_null($request->name)) {
            $data->name = $request->name;
        }

        if (!is_null($request->email)) {
            $data->email = $request->email;
        }

        if (!is_null($request->password)) {
            $data->password = Hash::make($request->password);
        }

        if (!is_null($regionId)) {
            $data->region_id = $regionId;
        }

        $data->save();
        // dd($data);
        // $data->save;
    }
    public static function createCourse($request)
    {
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount
        ]);
        return $course;
    }
    public static function createCourseCategory(array $request, $courseId)
    {
        // for ($i=0; $i <count($request) ; $i++) {
        //     CategoryCourse::create(['course_id'=>$courseId,'category_id'=>Category::where('name',$request[$i])]);
        // }
        // return $request;
        // try {
        // DB::beginTransaction();
        // "category":[
        //     "test","aaaa","aaaa","sss"
        // ]
        foreach ($request as $categoryName) {
            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                if (Helper::checkIfCategoryDuplicate($category->id, $courseId))
                    continue;
                CategoryCourse::create([
                    'course_id' => $courseId,
                    'category_id' => $category->id,
                ]);
            } else {
                continue;
            }
            // else {
            //     throw new \Exception("Category '{$categoryName}' not found.");
            // }
        }

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return response()->json(['error' => $e->getMessage()], 404);
        // }
    }
    public static function checkIfCategoryDuplicate($categoryId, $courseId)
    {
        $categoryCourseId = CategoryCourse::where('course_id', $courseId)->where('category_id', $categoryId)->first();
        return ($categoryCourseId != null);
    }
    public static function checkIfWishlistExists($courseId, $userId)
    {
        $wishlist = Wishlist::where('course_id', $courseId)->where('user_id', $userId)->first();
        return ($wishlist != null);
    }
    public static function getRegionId(array $region)
    {
        $regionId = Region::select('id')->where('name', $region['name'])->where('city', $region['city'])->first();

        return $regionId['id'];
    }
    public static function checkIfRateExists($request, $courseId)
    {
        return Rate::where('user_id', auth()->user()->id)->where('rate', $request->rate)->where('course_id', $courseId)->first();
    }
    public static function createRate($request, $courseId)
    {
        $rate = Rate::create([
            'user_id' => auth()->user()->id,
            'course_id' => $courseId,
            'rate' => $request->rate,
            'review' => $request->review
        ]);
        return $rate;
    }
}
