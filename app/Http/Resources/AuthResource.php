<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
return [
    'id'=>$this['user']->id,
'name'=>$this['user']->name,
'email'=>$this['user']->email,
'image'=>$this['user']->image,
'dateOfBirth'=>$this['user']->dateOfBirth,
'role'=>$this['user']->role,
'gender'=>$this['user']->gender,
'region' => [
    'city' => isset($this['user']->region->city) ? $this['user']->region->city : null,
    'name' => isset($this['user']->region->name) ? $this['user']->region->name : null,
],
'token' => $this['token'],
];
    }
}
