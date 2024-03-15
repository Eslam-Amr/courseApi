<?php

namespace App\Http\Requests;

use App\Models\Group;
use App\Rules\ValidInstructorId;
use App\Rules\ValidMentorId;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
        $groupId = $this->input('group_id');

        return [
            //
            'date' =>  [
                'required',
                'date',

                function ($attribute, $value, $fail) use ($groupId) {
                    $group = Group::select('start_date', 'end_date')->findOrFail($groupId);
                    $startDate = $group->start_date;
                    $endDate = $group->end_date;
                    if ($value < $startDate || $value > $endDate) {
                        $fail("The date must be within the start and end date of the group.");
                    }
                },
            ],
            'group_id' => 'required|exists:groups,id',
            'assignment_id' => 'required|exists:assignments,id',
            // 'instractor_id'=>'required|exists:technical_employees,id',
            'instractor_id' => ['required', new ValidInstructorId, 'exists:technical_employees,id'],

            'mentor_id' => ['required', new ValidMentorId, 'exists:technical_employees,id'],
            'number_of_attendance' => 'numeric',
        ];
    }
}
