<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentSolutionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "assignment_solution_id"=>$this->id ,
            "assignment_id"=> AssignmentResource::make($this->assignment),
        "group_id"=>GroupResource::make($this->group),
        "solution_link"=> $this->solution_link,
        "user_id"=> UserResource::make($this->user),
        "date"=> $this->date,
        ];
    }
}
