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


            "id"=> $this->id,
            "date"=> $this->date,
            "group"=> [
                "max_student"=>  $this->group->max_student,
                "registered_student"=>  $this->group->registered_student,
                "name"=>  $this->group->name,
                "start_date"=>  $this->group->start_date,
                "end_date"=>  $this->group->end_date,


                ],
            "assignment_id"=> [

                "type"=>$this->assignment->type?? null,

                "file"=>$this->assignment->file ?? null,

     "start_date"=>$this->assignment->start_date ?? null,
                "dead_line"=>$this->assignment->dead_line ?? null,

               ],
            "instractor_id"=>[
                "number_of_group" => $this->instractor->number_of_group?? null,
                "name" => $this->instractor->user->name?? null,
                "email" => $this->instractor->user->email?? null,
            ],
            "mentor"=> [
                "number_of_group" => $this->mentor->number_of_group?? null,
                "name" => $this->mentor->user->name?? null,
                "email" => $this->mentor->user->email?? null,
            ],
            "number_of_attendance"=> $this->number_of_attendance,

            // 'salary' => $request->salary,
            // 'role' => $request->role,
            // 'number_of_group' => $request->working_hour,
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'image' => $request->image,
            // 'dateOfBirth' => $request->dateOfBirth,
            // 'gender' => $request->gender,
            // 'region' => [
            //     'city' => isset($request['region']['city']) ? $request['region']['city'] : null,
            //     'name' => isset($request['region']['name']) ? $request['region']['name'] : null,
            // ]
            // 'region' => [
            //     'name'=>$this->region->name,
            //     'city'=>$this->region->city
            //     ]
        ];    }
}
