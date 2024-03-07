<?php

namespace App\Http\Requests;

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
    public function rules(): array
    {
        return [
            //
            'max_student'=>'required|numeric|min:1',
'registered_student'=>'required|numeric|min:0',
'name'=>'required|min:3|max:12',
'start_date'=>'required|date',
'end_date'=>'required|date',
        ];
    }
}
