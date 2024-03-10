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
        // dd($request,$this[0]);
        return [
            'description'=>$this->description ?? null,
            'name'=>$this->name ?? null,
            'price'=>$this->price ??null,
            'discount'=>$this->discount??null,

            'rates' => $this->rates,
            // 'rates' => $this->formatRates($this->rates)??null,

'categories' => $this->categories->pluck('name')??null
        ];
    }
    private function formatRates($rates)
    {
        return $rates->map(function ($rate) {
            return [
                'userName' => $rate->user->name??null,
                'rate' => $rate->rate??null,
                'review' => $rate->review??null,
            ];
        });
    }
}
