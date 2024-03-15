<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Services\AdminServices\GroupServices\GroupServices;
use App\Traits\GeneralTrait;
use DateTime;
use Helper;
use Illuminate\Http\Request;

class GroupController extends Controller
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
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request,GroupServices $groupServices)
    {
$group=$groupServices->store($request);
        try {

            return $this->apiResponse($group,'success',200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($groupId,GroupServices $groupServices)
    {
        $group=$groupServices->show($groupId);
        try {
            return $this->apiResponse($group, 'success', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($groupId ,GroupServices $groupServices)
    {
        $group=$groupServices->destroy($groupId);
        try {
            return $this->apiResponse($group, 'deleted successfuly', 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
