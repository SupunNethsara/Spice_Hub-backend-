<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required',
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
