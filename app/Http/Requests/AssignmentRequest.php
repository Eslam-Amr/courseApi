<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
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
    // 'start_date' => 'required|date_format:Y-m-d|before:end_date',
    // 'end_date' => 'required|date_format:Y-m-d|after:start_date',
    public function rules(): array
    {
        return [
            //
            'type' => 'required|in:search,assignment',
            'file' => 'required',
            // 'descreption'=>'required|min:3|max:100',
            'start_date' => 'required|date_format:Y-m-d|before:dead_line',
            'dead_line' => 'required|date_format:Y-m-d|after:start_date',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:groups,id',
            'descreption' => 'min:3|max:255',
        ];
    }
}
