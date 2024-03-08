<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
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
            'description' => 'required|min:3',
            'name' => 'required|min:3|max:20',
            'price' => 'required|numeric',
            'discount' => 'numeric',
            'category' => 'required|array',
            'category.id' => 'required|exists:categories,id',
        ];
    }
}
