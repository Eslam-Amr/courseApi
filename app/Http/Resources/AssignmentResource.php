<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'assignment_id' => $this->id,
            'type' => $this->type,
            'file' => $this->file,
            'start_date' => $this->start_date,
            'dead_line' => $this->dead_line,
            // 'course_id' => $this->course_id,
            'descreption' => $this->descreption,
            'group_id' => GroupResource::make($this->group),

        ];
    }
}
