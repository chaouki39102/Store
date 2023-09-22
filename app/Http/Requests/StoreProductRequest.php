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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_code' => 'string|min:1|max:20',
            'name' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:2|max:650',
            'quantity' => 'integer|numeric|min:0.00',
            'purchase_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'sale_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0.00',
            'image_url' => 'nullable|mimes:png,jpg,jpeg,gif,svg',
            'category_id' => 'required|integer|exists:categories,id',
            'status' => 'nullable|string',
        ];
    }
    
}
