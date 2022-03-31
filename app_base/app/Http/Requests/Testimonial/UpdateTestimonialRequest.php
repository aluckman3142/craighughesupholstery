<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_name' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'customer_location' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'text' => [
                'required',
                'string',
                'min:20',
                'max:255',
            ],
        ];
    }
}
