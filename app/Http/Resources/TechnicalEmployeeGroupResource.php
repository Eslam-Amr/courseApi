<?php

namespace App\Http\Resources;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TechnicalEmployeeGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'group'=>GroupResource::make($this->group),
            'group'=>GroupResource::make(Group::find($this->group_id)),
            // 'technicalEmployee'=>TechnicalEmployeeResource::make($this->technicalEmployee),
        ];
    }
}
