<?php

namespace App\Domain\Movies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'name' => ['required', 'string', 'max:200'],
            'password' => ['required', 'string', 'min:6', 'max:25'],
        ];
    }
}