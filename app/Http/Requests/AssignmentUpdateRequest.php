<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentUpdateRequest extends FormRequest
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
        return [
            'type' => 'in:search,assignment',
            // 'descreption'=>'min:3|max:100',
            'file'=>'',
            'start_date' => 'date_format:Y-m-d|before:dead_line',
            'dead_line' => 'date_format:Y-m-d|after:start_date',
            'course_id' => 'exists:courses,id',
        ];
    }
}
