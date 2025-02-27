<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image',
        ];
    }
}
