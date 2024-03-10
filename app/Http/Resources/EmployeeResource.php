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

            'salary' => $this->salary,
            'role' => $this->role,
            'working_hour' => $this->working_hour,
            'working_place' => $this->working_place,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'image' => $this->user->image,
            'dateOfBirth' => $this->user->dateOfBirth,
            'gender' => $this->user->gender,
            // 'region' => [
                //     'city' => isset($request['region']['city']) ? $request['region']['city'] : null,
                //     'name' => isset($request['region']['name']) ? $request['region']['name'] : null,
                // ]
                // 'region' => $request->region
                // 'region' => [
                //     'name'=>$this->user,
                //     'city'=>$this->user
                //     ]
        ];
    }
}
