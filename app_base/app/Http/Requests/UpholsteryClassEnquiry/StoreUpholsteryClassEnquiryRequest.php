<?php

namespace App\Http\Requests\UpholsteryClassEnquiry;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpholsteryClassEnquiryRequest extends FormRequest
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
            'project_description' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
            'days_required' => [
                'integer',
                'required',
            ],
            'width' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
            'height' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
            'depth' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
            'start_date' => [
                'required',
            ],
            'end_date' => [
                'required',
                'after:start_date',
            ],
            'upload' => [
                'image',
                'mimes:jpeg,png'
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
