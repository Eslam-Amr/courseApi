<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
    // 'registered_student'=>'required|numeric|min:0',
    // 'registered_student' => [
    //     'required',
    //     'numeric',
    //     'min:0',
    //     function ($attribute, $value, $fail) {
    //         if ($this->filled('max_student')) {
    //             $maxStudent = $this->input('max_student');
    //             if ($value >= $maxStudent) {
    //                 $fail('The ' . $attribute . ' must be less than max student.');
    //             }
    //         }
    //     }
    // ],
    public function rules(): array
    {
        return [
            //
            'max_student' => 'required|numeric|min:1',
            'course_id' => 'required|exists:courses,id',
            // 'registered_student' => 'required|numeric|min:0|lte:max_student', // Ensure registered_student is less than max_student ,
            'name' => 'required|min:3|max:12|unique:groups,name',
            // 'start_date' => 'required|date|before:end_date',
            // 'end_date' => 'required|date|after:start_date',
            'start_date' => 'required|date_format:Y-m-d|before:end_date',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'instractor_id' => 'nullable|numeric|exists:technical_employees,id',
            'mentor_id' => 'nullable|numeric|exists:technical_employees,id',
        ];
    }
    public function messages()
    {
        return [
            'registered_student.lte' => 'The registered student must be less than or equal to max student.',
            'registered_student.min' => 'The registered student must be postive number.',
            'max_student.min' => 'The max student must be postive number.',
        ];
    }
}
