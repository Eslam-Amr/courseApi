<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TechnicalEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'salary' => $request->salary,
            'role' => $request->role,
            'number_of_group' => $request->working_hour,
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            // 'region' => [
            //     'city' => isset($request['region']['city']) ? $request['region']['city'] : null,
            //     'name' => isset($request['region']['name']) ? $request['region']['name'] : null,
            // ]
            // 'region' => [
            //     'name'=>$this->region->name,
            //     'city'=>$this->region->city
            //     ]
        ];
    }
}
