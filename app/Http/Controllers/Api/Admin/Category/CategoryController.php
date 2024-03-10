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
    public function index(CategoryServices $categoryServices)
    {
        //
        $category=$categoryServices->index();
        try {

            // return response()->json(['category'=>$category,'status'=>'success'],200);
            return $this->apiResponse($category , 'success',200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request,CategoryServices $categoryServices)
    {
        //
        try {
            $category=$categoryServices->store($request);
            if($category==null){
                return $this->returnError("something went wrong",422);
            }
            return response()->json(['category'=>$category,'status'=>'success'],200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($categoryId , CategoryServices $categoryServices)
    {
        //
        $category=$categoryServices->show($categoryId);
        try {

            // return response()->json(['category'=>$category,'status'=>'success'],200);
            return $this->apiResponse($category , 'success',200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());

        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$id,CategoryServices $categoryServices)
    {
        $category=$categoryServices->update($request,$id);
return response()->json(['category'=>$category,'status'=>'edited success'],200);

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
