<?php

namespace App\Http\Requests\AccommodationImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccommodationImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('accommodation_images'),
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
        ];
    }
}
