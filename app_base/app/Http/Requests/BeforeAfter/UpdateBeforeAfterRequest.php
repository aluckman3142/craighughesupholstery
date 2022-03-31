<?php

namespace App\Http\Requests\BeforeAfter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBeforeAfterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('before_afters')->ignore($this->beforeAfter->id, 'id'),
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
            ]
        ];
    }
}
