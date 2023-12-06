<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BusinessCategoryRequest extends FormRequest
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
            'category_name' => [
                'required',
                Rule::unique('business_categories', 'category_name')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
                'min:2',
                'max:50',
            ],
        ];
    }
}
