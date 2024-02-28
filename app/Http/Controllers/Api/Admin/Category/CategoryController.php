<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\adminServices\CategoryServices\CategoryServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryRequest $request,CategoryServices $categoryServices)
    {
        //
        try {
            // $data= $LoginServices->login($request);
            $category=$categoryServices->create($request);
            if($category==null){
                return $this->returnError("something went wrong",422);
            }
            return response()->json(['category'=>$category,'status'=>'success'],200);
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryRequest $request,$id,CategoryServices $categoryServices)
    {
        //
$category=$categoryServices->edit($request,$id);
return response()->json(['category'=>$category,'status'=>'edited success'],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryServices $categoryServices,$id)
    {
        //
            // $data= $LoginServices->login($request);
            $category=$categoryServices->destroy($id);
            if($category==null){
                return $this->returnError(" something went wrong",422);
            }
            $category->delete();
            return response()->json(['category'=>$category,'status'=>'deleted success'],200);


    }
}
