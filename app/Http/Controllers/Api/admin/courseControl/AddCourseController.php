<?php

namespace App\Http\Controllers\APi\admin\courseControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCreateRequest;
use App\Models\Course;
use App\Services\adminServices\CourseServices\CourseServices;
use Illuminate\Http\Request;

class AddCourseController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    // Auth::guard("admin")
    /**
     * Show the form for creating a new resource.
     */
    public function create(CourseCreateRequest $request,CourseServices $courseServices)
    {
        // return $request['category'];
        //
        try {
            // $courseServices->create($request);
            $course=$courseServices->create($request);
            return response()->json(['course'=>$course,'status'=>'success'],200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

/**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
