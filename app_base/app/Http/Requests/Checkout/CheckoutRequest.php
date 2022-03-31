<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {

        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        return [
            'email' => $emailValidation,
            'title' => 'required',
            'forename' => [
                'required',
                'string',
            ],
            'surname' => [
                'required',
                'string',
            ],
            'address1' => [
                'required',
                'string',
            ],
            'address2' => [
                'sometimes',
                'string',
            ],
            'town' => [
                'required',
                'string',
            ],
            'county' => [
                'sometimes',
                'string',
            ],
            'postcode' => [
                'required',
                'string',
                'postal_code:GB'
            ],
            'phone' => [
                'sometimes',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => "An account with this email address already exists. Please <a class='underline' href='/login'>login</a> to continue.",
            'postcode.postal_code' => "Shipping Address must be a valid UK Postcode."
        ];
    }
}
