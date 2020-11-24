<?php

namespace App\Admin\Requests;

class AuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
