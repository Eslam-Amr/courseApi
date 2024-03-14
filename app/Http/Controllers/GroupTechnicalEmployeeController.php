<?php

namespace App\Http\Controllers;

use App\Actions\TechnicalEmployeeGroupActions\TechnicalEmployeeGroupAction;
use App\Actions\TechnicalEmployeeGroupActions\TechnicalEmployeeGroupUpdateAction;
use App\Http\Requests\GroupTechnicalEmployeeRequest;
use App\Http\Requests\GroupTechnicalEmployeeUpdateRequest;
use App\Http\Resources\TechnicalEmployeeGroupResource;
use App\Http\Resources\TechnicalEmployeeResource;
use App\Models\GroupTechnicalEmployee;
use App\Models\TechnicalEmployee;
use App\Services\adminServices\TechnicalEmployeeServices\TechnicalEmployeeGroupServices;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GroupTechnicalEmployeeController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {

        $technicalEmployeeGroup = $technicalEmployeeGroupServices->index();
        return $technicalEmployeeGroup;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupTechnicalEmployeeRequest $request, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices, TechnicalEmployeeGroupAction $technicalEmployeeGroupAction)
    {
        $ifExists = $technicalEmployeeGroupAction->handle($request);
        if ($ifExists==1)
            return $this->apiResponse('null', "alredy exists", 200);
        if ($ifExists==2)
            return $this->apiResponse('null', "there is employee alredy exists in this postion", 200);
        $employee = $technicalEmployeeGroupServices->store($request);
        return $this->apiResponse($employee, 'added successfuly', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {
        //
        $technicalEmployeeGroup = $technicalEmployeeGroupServices->show($id);
        try {
            return $this->apiResponse((new TechnicalEmployeeGroupResource($technicalEmployeeGroup)), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupTechnicalEmployeeUpdateRequest $request, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices, $id,TechnicalEmployeeGroupUpdateAction $technicalEmployeeGroupAction)
    {
        $ifExists = $technicalEmployeeGroupAction->handle($request,$id);
        if ($ifExists==1)
            return $this->apiResponse('null', "alredy exists", 200);
        if ($ifExists==2)
            return $this->apiResponse('null', "there is employee alredy exists in this postion", 200);
        $technicalEmployeeGroup = $technicalEmployeeGroupServices->update($request, $id);
        try {
            return $this->apiResponse((new TechnicalEmployeeGroupResource($technicalEmployeeGroup)), 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, TechnicalEmployeeGroupServices $technicalEmployeeGroupServices)
    {
        return $this->apiResponse($technicalEmployeeGroupServices->destroy($id), 'deleted successfuly', 200);
    }
}
