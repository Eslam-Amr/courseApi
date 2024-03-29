<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($request, $this->user, $this->session);
        return  [
            'attendance_id' => $this->id,
            'evaluation' => $this->evaluation,
            'user' => UserResource::make($this->user),
            'session' => SessionResource::make($this->session),
        ];
    }
}
