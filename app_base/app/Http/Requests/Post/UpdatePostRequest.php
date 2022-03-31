<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('posts')->ignore($this->post->id, 'id'),
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'intro_text' => [
                'required',
                'string',
                'min:20',
                'max:255',
            ],
            'main_text' => [
                'required',
                'string',
                'min:20',
                'max:5000',
            ],
            'published_date' => [
                'required',
            ],
            'published_by' => [
                'required',
            ],
            'link' => [
                'string',
                'min:5',
                'max:255',
            ]
        ];
    }
}
