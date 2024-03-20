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
        // dd($request,$this->id);
//         var_dump($this->course->price - ($this->course->price * ($this->course->discount / 100)));
// die;
        // dd($this->course->price - ($this->course->price * ($this->course->discount / 100)));
        return [
            'id' => $this->id,
            'description' => $this->description ?? null,
            'name' => $this->name ?? null,
            'price' => $this->price ?? null,
            'discount' => $this->discount ?? null,
            'course_price_after_discount' => $this->price - ($this->price * ($this->discount / 100)),
            // 'rates' => $this->rates,
            'rates' => $this->formatRates($this->rates)??null,
            'average_rate' => $this->calculateAverageRate($this->rates),

            'categories' => $this->categories->pluck('name') ?? null
        ];
    }
    private function formatRates($rates)
    {
        return $rates->map(function ($rate) {
            return [
                'userName' => $rate->user->name ?? null,
                'rate' => $rate->rate ?? null,
                'review' => $rate->review ?? null,
            ];
        });
    }
    private function calculateAverageRate($rates)
    {
        if ($rates->isEmpty()) {
            return 0;
        }

        $totalRate = $rates->sum('rate');
        $count = $rates->count();
if($count !== 0)
$avgRate=$totalRate / $count;
else
$avgRate=0;
return $avgRate==null? 0 : $avgRate;
    }

}
