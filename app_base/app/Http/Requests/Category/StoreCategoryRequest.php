<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('categories'),
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'short_desc' => [
                'required',
                'string',
                'min:20',
                'max:255',
            ],
            'long_desc' => [
                'required',
                'string',
                'min:20',
                'max:1000',
            ],
            'button_text' => [
                'required',
                'string',
                'min:5',
                'max:40',
            ],
            'button_path' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
