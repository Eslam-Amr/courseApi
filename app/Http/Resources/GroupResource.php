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
        // dd($this->course->name);
        return [


            "group_id" => $this->id,
            "group_name" => $this->name,
            "group_start_date" => $this->start_date,
            "group_end_date" => $this->end_date,
            "course" => [
                'course_id' => $this->course->id,
                'course_name' => $this->course->name,
                'course_description' => $this->course->description,
                'course_price' => $this->course->price,
                'course_discount' => $this->course->discount,
                //1000 20% 0.2 200 800
                'course_price_after_discount' => $this->course->price - ($this->course->price * ($this->course->discount / 100)),
            ]

        ];
    }
}
