<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

public function toArray(Request $request): array
{
    $data = [
        "group_id" => $this->id,
        "group_name" => $this->name,
        "group_start_date" => $this->start_date,
        "group_end_date" => $this->end_date,
        'course' => CourseResource::make($this->course),
    ];

    // Check if mentor exists, then include it
    $data['mentor'] = isset($this->mentor[0]) ? TechnicalEmployeeResource::make($this->mentor[0]) : null;

    // Check if instructor exists, then include it
    $data['instructor'] = isset($this->instractor[0]) ? TechnicalEmployeeResource::make($this->instractor[0]) : null;

    return $data;
}

}
