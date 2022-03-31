<?php

namespace App\Http\Requests\CategoryImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('category_images')->ignore($this->categoryImage->id, 'id'),
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'description' => [
                'required',
                'string',
                'min:20',
                'max:1000',
            ],
            'category' => [
                'required',
                'integer',
            ],
        ];
    }
}
