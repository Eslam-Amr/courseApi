<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'dateOfBirth' => $this->dateOfBirth,
            'gender' => $this->gender,
            'region' => [
                'city' => auth()->user()->region->city,
                'name' => auth()->user()->region->name
            ]
        ];
      }
}
