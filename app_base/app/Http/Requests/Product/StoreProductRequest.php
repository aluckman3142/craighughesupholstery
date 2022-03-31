<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                Rule::unique('products'),
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'product_code' => [
                Rule::unique('products'),
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'tagline' => [
                'required',
                'string',
                'min:20',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'min:20',
                'max:2000',
            ],
            'price' => [
                'numeric',
            ]
        ];
    }
}
