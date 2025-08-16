<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_sname' => 'required',
            'brand' => 'required',
            'Product_price' => 'required|numeric',
            'category' => 'required|string',
            'weight' => 'required|numeric',
            'unit_of_measurement' => 'required',
            'stock' => 'required|integer',
            'expiry_date' => 'required|date',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|max:5120',
        ];
    }
}
