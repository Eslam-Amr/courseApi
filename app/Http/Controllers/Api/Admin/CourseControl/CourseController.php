<?php

namespace App\Http\Controllers\APi\Admin\CourseControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
// use App\Models\Course;
use App\Services\AdminServices\CourseServices\CourseServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'check.permission:course-delete,delete'
        ])->only(['destroy']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:course-update,update'
        ])->only(['update']);

        $this->middleware([
            'auth:sanctum',
            'check.permission:course-store,store'
        ])->only(['store']);
    }

    public function index( CourseServices $courseServices ){
        $course = $courseServices->index();
        try {

            return $this->apiResponse(CourseCollection::make($course),__('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCreateRequest $request, CourseServices $courseServices)
    {

        // return $request['category'];
        //
        $course = $courseServices->store($request);
        // dd($course);
        try {
            // $courseServices->create($request);
            return $this->apiResponse(CourseResource::make($course),__('response/response_message.created_success'), 200);
            // return response()->json(['course'=>$course,'status'=>'success'],200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, CourseServices $courseServices)
    {
        $course = $courseServices->show($id);
        try {
            return $this->apiResponse(CourseResource::make($course),__('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,CourseServices $courseServices)
    {
        //
        $course=$courseServices->destroy($id);
            try {
                return $this->apiResponse(CourseResource::make($course),__('response/response_message.deleted_success'), 200);
            } catch (\Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
    }
    public function update($id,CourseServices $courseServices,CourseUpdateRequest $request){
        // return $id;

        $course=$courseServices->update($request,$id);
        try {
            return $this->apiResponse(CourseResource::make($course),__('response/response_message.updated_success'), 200);
        }  catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
