<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_role' => 'required|numeric|min:1|max:3',
            'name' => 'required|min:2|max:70|',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20|confirmed',
            'country' => 'required',
            'image' => 'image',
        ];
    }
}
