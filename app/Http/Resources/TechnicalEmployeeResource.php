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
        // dd($request->user,$this->user);
        return [
            'technical_employee_id' => $this->id,
            'salary' => $this->salary,
            'role' => $this->role,
            'number_of_group' => $this->number_of_group,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'image' => $this->user->image,
            'dateOfBirth' => $this->user->dateOfBirth,
            'gender' => $this->user->gender,
            'region' => [
                'city' => isset($this->user->region->city) ? $this->user->region->city : null,
                'name' => isset($this->user->region->name) ? $this->user->region->name : null,
            ]
            // 'region' => RegionResource::make($this->region)

        ];
    }
}
