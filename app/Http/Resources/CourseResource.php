<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'description'=>$this->description,
            'name'=>$this->name,
            'price'=>$this->price,
            'discount'=>$this->discount,

            // 'rates' => $this->rates,
            'rates' => $this->formatRates($this->rates),

'categories' => $this->categories->pluck('name')
        ];
    }
    private function formatRates($rates)
    {
        return $rates->map(function ($rate) {
            return [
                'userName' => $rate->user->name,
                'rate' => $rate->rate,
                'review' => $rate->review,
            ];
        });
    }
}
