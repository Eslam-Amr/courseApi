<?php

namespace App\Http\Controllers\Api\User\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Services\userServices\RateServices\RateServices;
use App\Traits\GeneralTrait;
use Helper;
use Illuminate\Http\Request;

class RateController extends Controller
{
    use GeneralTrait;
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
    public function create(RateRequest $request, $id, RateServices $rateServices)
    {
        //
        try {

            if (Helper::checkIfRateExists($request, $id)) {
                return response()->json(['message' => 'review already posted'], 200);
            }
            // try {

            $rate = $rateServices->create($id, $request);
            if ($rate != null) {
                return response()->json(['message' => 'review posted successfully', 'rate' => $rate], 200);
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
        // } catch (\Exception $ex) {
        //     return $this->returnError($ex->getCode(), $ex->getMessage());

        // }

        // return $request->validated();
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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId,RateServices $rateServices)
    {
        //
        try {
            $rate = $rateServices->destroy($courseId);
            if ($rate!= null) {
                return response()->json(['message' => 'rate deleted successfully','rate' => $rate], 200);
            }
            return response()->json(['message' => 'rate not found'], 200);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
}
