<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentSolutionRequest extends FormRequest
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
            //
            'assignment_id'=>'required|exists:assignments,id',
            'group_id'=>'required|exists:groups,id',
'solution_link'=>'required|url',
'note'=>'nullable|min:3|max:100',
// 'date'=>'required|date_format:Y-m-d|after:start_date',
        ];
    }
}
