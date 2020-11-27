<?php

namespace App\Admin\Requests;

class AdminUserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string',
                    'avatar' => 'nullable|string',
                    'username' => 'required|string|unique:admin_users',
                    'password' => 'required|string|confirmed',
                    'roles' => 'nullable|array',
                    'permissions' => 'nullable|array',
                ];
            case 'PUT':
                $model = $this->route('admin_user');
                return [
                    'name' => 'required|string',
                    'avatar' => 'nullable|string',
                    'username' => 'required|string|unique:admin_users,username,' . $model->id,
                    'password' => 'nullable|string|confirmed',
                    'roles' => 'nullable|array',
                    'permissions' => 'nullable|array',
                ];
        }
    }
}
