<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [


            "session_id" => $this->id,
            "date" => $this->date,
            "assignment" => AssignmentResource::make($this->assignment),
            "number_of_attendance" => $this->number_of_attendance,
        ];
    }
}
