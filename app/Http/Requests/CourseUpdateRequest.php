<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
            'description' => 'min:3',
            'name' => 'min:3|max:20',
            'price' => 'numeric',
            'discount' => 'numeric',
            // 'category' => 'array',
            'category_id' => 'exists:categories,id|array',        ];
    }
}
