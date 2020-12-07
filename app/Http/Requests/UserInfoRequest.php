<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        if($request['id']){
            $id = ',' . $request['id'];
        }
        return [
            'id' => 'required|numeric',
            'name' => 'required|min:2|max:70|',
            'email' => 'required|email|unique:users,email'. $id,
            'country' => 'required',
        ];
    }
}
