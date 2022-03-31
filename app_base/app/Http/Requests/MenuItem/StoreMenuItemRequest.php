<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                Rule::unique('menu_items'),
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'url_path' => [
                Rule::unique('menu_items'),
                'required',
                'string',
                'min:3',
                'max:255',
            ],
        ];
    }
}
