<?php
// namespace App\Services;
namespace App\Services\AdminServices\SessionServices;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\SessionRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Models\Admin;
use App\Models\Empolyee;
use App\Models\Region;
use App\Models\Session;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class SessionServices
{
    use GeneralTrait;

    public function index(){
return Session::paginate();

    }
    public function store(SessionRequest $request, $groupId)
    {

        // try {
        $session = Session::create(array_merge($request->validated(), ['group_id' => $groupId]));
        return $session;
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }
    public function show($sessionId){

        return Session::findOrFail($sessionId);
    }
    public function update(SessionUpdateRequest $request,$sessionId)
    {
        $session = Session::findOrFail($sessionId);
        $session->update($request->validated());
        return $session;
    }
    public function destroy($sessionId){
        $session=Session::findOrFail($sessionId);
        $session->delete();
        return $session;
    }
}
