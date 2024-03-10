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
            'salary' => $this->salary,
            'role' => $this->role,
            'number_of_group' => $this->number_of_group,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'image' => $this->user->image,
            'dateOfBirth' => $this->user->dateOfBirth,
            'gender' => $this->user->gender,
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
