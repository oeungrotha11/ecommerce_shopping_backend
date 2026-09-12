<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',

            'code' => 'required|string|max:255|unique:products,code',

            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'base_price' => 'required|numeric|min:0',

            'image' => 'nullable|string|max:255',

            'status' => 'nullable|in:active,inactive',
        ];
    }
}
