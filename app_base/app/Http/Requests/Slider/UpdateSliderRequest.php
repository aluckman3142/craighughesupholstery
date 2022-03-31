<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSliderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('sliders')->ignore($this->slider->id, 'id'),
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'text' => [
                'required',
                'string',
                'min:20',
                'max:255',
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
