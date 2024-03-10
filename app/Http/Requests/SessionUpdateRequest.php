<?php

namespace App\Http\Requests;

use App\Models\Group;
use App\Models\Session;
use App\Rules\ValidInstructorId;
use App\Rules\ValidMentorId;
use Illuminate\Foundation\Http\FormRequest;

class SessionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $sessionId = $this->route('sessionId');
        $groupId=Session::select('group_id')->findOrFail($sessionId);
        $group = Group::select('start_date','end_date')->findOrFail($groupId)[0];

        return [
            //
            'date' =>  [
                'date',
                // function ($attribute, $value, $fail) {
                //     $group = Group::select('start_date', 'end_date')->findOrFail($this->input('group_id'));
                //     $startDate = $group->start_date;
                //     $endDate = $group->end_date;
                //     if ($value < $startDate || $value > $endDate) {
                //         $fail("The date must be within the start and end date of the group.");
                //     }
                // },
                function ($attribute, $value, $fail) use ($group) {
                    // $group = Group::select('start_date', 'end_date')->findOrFail($groupId);
                    // dd($group->start_date);
                    $startDate = $group->start_date;
                    $endDate = $group->end_date;
                    if ($value < $startDate || $value > $endDate) {
                        $fail("The date must be within the start and end date of the group.");
                    }
                },
            ],
            // 'group_id' => '|exists:groups,id',
            'assignment_id' => 'exists:assignments,id',
            // 'instractor_id'=>'|exists:technical_employees,id',
            'instractor_id' => [ new ValidInstructorId, 'exists:technical_employees,id'],

            'mentor_id' => [ new ValidMentorId, 'exists:technical_employees,id'],
            'number_of_attendance' => 'numeric',
        ];
    }
}
