<?php

namespace App\Http\Requests\FabricLink;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFabricLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('fabric_links')->ignore($this->fabricLink->id, 'id'),
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'link' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
        ];
    }
}
