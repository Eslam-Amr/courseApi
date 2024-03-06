<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function getSingleCourse($id){
        // try {
            $course=Course::with('rates.user', 'categories')->findOrFail($id);
           return $this->apiResponse((new CourseResource($course)),'success',200);

        // } catch (\Exception $ex) {
            // return $this->returnError($ex->getCode(), $ex->getMessage());

        // }
    }
    // Auth::guard("admin")
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
