<?php

namespace App\Domain\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'movie_id' => ['required', 'string', 'uuid'],
        ];
    }
}