<?php

namespace App\Http\Resources;

use App\Models\Region;
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
        // dd($this->name);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'dateOfBirth' => $this->dateOfBirth,
            'gender' => $this->gender,
            'region' => RegionResource::make(Region::find($this->region_id))
            // 'region' => [
            //         'city' => isset($request['region']['city']) ? $request['region']['city'] : null,
            //         'name' => isset($request['region']['name']) ? $request['region']['name'] : null,
            //     ]
                // 'region' => [
                //     'name'=>$this->region->name,
                //     'city'=>$this->region->city
                //     ]
        ];
      }
}
