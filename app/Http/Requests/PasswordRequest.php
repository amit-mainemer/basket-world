<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:6|max:20|confirmed',
        ];
    }
}
