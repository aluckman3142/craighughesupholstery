<?php

namespace App\Http\Requests\BeforeAfter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBeforeAfterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('before_afters'),
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
            'before_image_name' => [
                'required',
            ],
            'after_image_name' => [
                'required',
            ],
        ];
    }
}
