<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array{
        return [
            'customer_name.required' => 'Customer name is required',
            'customer_name.string' => 'Customer name must be string',
            'customer_name.max' => 'Customer name is too long',
            'items.required' => 'Items is required',
            'items.array' => 'Items must be array',
            'items.*.product_id.required' => 'Product id is required',
            'items.*.product_id.integer' => 'Product id must be integer',
            'items.*.product_id.exists' => 'Product id must be integer'
        ];
    }
}
