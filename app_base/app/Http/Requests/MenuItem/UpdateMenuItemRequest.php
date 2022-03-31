<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                Rule::unique('menu_items')->ignore($this->menuItem->id, 'id'),
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'url_path' => [
                Rule::unique('menu_items')->ignore($this->menuItem->id, 'id'),
                'required',
                'string',
                'min:3',
                'max:255',
            ],
        ];
    }
}
