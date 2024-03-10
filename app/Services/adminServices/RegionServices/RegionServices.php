<?php
// namespace App\Services;
namespace App\Services\adminServices\RegionServices;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\Region;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class RegionServices
{
    use GeneralTrait;

    public function store(RegionRequest $request)
    {
        try {

            $region=Region::create($request->validated());
            return $region;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show($RegionId){
        return Region::findOrFail($RegionId);
    }
    public function index(){
        return Region::paginate();
    }
    public function update($RegionId, RegionUpdateRequest $request){
        $region=Region::findOrFail($RegionId);
        $region->update($request->validated());
        return $region;
    }
    public function destroy($RegionId){
        $region=Region::findOrFail($RegionId);
        $region->delete();
        return $region;
    }
}
