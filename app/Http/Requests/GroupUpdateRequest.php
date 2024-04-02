<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUpdateRequest extends FormRequest
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
            'max_student' => 'numeric|min:1',

            'name' => 'min:3|max:12|unique:groups,name',

            'start_date' => 'date_format:Y-m-d|before:end_date',

            'end_date' => 'date_format:Y-m-d|after:start_date',

        ];
    }
}
