<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'user_id' => $this->id,
                'user_name' => $this->name,
                'user_email' => $this->email,
                'user_phone' => $this->phone,
                'user_image' => $this->image,
                'user_date_of_birth' => $this->dateOfBirth,
                'user_role' => $this->role,
                'user_gender' => $this->gender,
'region'=>[
    'name'=>$this->region->name,
    'city'=>$this->region->city
],

            ];
    }
}
