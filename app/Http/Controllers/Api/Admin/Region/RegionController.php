<?php

namespace App\Http\Controllers\Api\Admin\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Http\Resources\RegionCollection;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use App\Services\adminServices\RegionServices\RegionServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(RegionServices $regionServices)
    {
        //
        $region = $regionServices->index();
        try {
            return $this->apiResponse(RegionCollection::make($region),__('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request, RegionServices $regionServices)
    {
        //
        $region=$regionServices->store($request);
        return $this->apiResponse(RegionResource::make($region), __('response/response_message.created_success'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($regionId, RegionServices $regionServices)
    {
        //
        $region = $regionServices->show($regionId);
        try {

            // return response()->json(['category'=>$category,'status'=>'success'],200);
            return $this->apiResponse(RegionResource::make($region), __('response/response_message.data_retrieved'), 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(RegionUpdateRequest $request, RegionServices $regionServices, $regionId)
    {
        //
        $region = $regionServices->update($regionId, $request);
        try {

            // return response()->json(['category'=>$category,'status'=>'success'],200);
            // return $this->apiResponse($region, 'success', 200);
        return $this->apiResponse(RegionResource::make($region), __('response/response_message.updated_success'), 200);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($regionId,RegionServices $regionServices)
    {
        //
        $region = $regionServices->destroy($regionId);
        try {
            // return $this->apiResponse($region, 'deleted successfully', 200);
        return $this->apiResponse(RegionResource::make($region), __('response/response_message.deleted_success'), 200);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
