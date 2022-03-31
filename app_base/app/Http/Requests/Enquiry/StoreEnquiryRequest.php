<?php

namespace App\Http\Requests\Enquiry;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquiryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            'email' => [
                'required',
                'string',
                'min:10',
                'max:255',
            ],
            'subject' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
            'captcha' => 'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'captcha.captcha' => "Please enter the captcha from the image."
        ];
    }
}
