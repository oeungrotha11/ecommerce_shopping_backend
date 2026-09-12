<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'category_id' => 'sometimes|exists:categories,id',

            'brand_id' => 'sometimes|exists:brands,id',

            'code' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('products', 'code')
                    ->ignore($product->id),
            ],

            'name' => 'sometimes|string|max:255',

            'description' => 'nullable|string',

            'base_price' => 'sometimes|numeric|min:0',

            'image' => 'nullable|string|max:255',

            'status' => 'sometimes|in:active,inactive',
        ];
    }
}
