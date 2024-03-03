<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

'salary'=>$request->salary,
'role'=>$request->role,
'working_hour'=>$request->working_hour,
'working_place'=>$request->working_place,
'name' => $request->name,
'email' => $request->email,
'image' => $request->image,
'dateOfBirth' => $request->dateOfBirth,
'gender' => $request->gender,
'region' => [
    'city' => isset($request['region']['city']) ? $request['region']['city'] : null,
    'name' => isset($request['region']['name']) ? $request['region']['name'] : null,
]
        ];
    }
}
