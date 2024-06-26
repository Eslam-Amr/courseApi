<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'email'=>'email|unique:users,email',
            'password'=>'min:5|max:16'
            ,'name'=>'min:3|max:12',
            'region_id' => 'exists:regions,id|numeric|nullable',

            // 'region' => 'array',
            // 'region.name' => 'string|exists:regions,name',
            // 'region.city' => 'string|exists:regions,city',

        ];
    }
}
