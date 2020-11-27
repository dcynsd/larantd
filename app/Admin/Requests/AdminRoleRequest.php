<?php

namespace App\Admin\Requests;

class AdminRoleRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'slug' => 'required|unique:admin_roles',
                    'permissions' => 'nullable|array',
                ];
            case 'PUT':
                $model = $this->route('admin_role');
                return [
                    'name' => 'required',
                    'slug' => 'required|unique:admin_roles,slug,' . $model->id,
                    'permissions' => 'nullable|array',
                ];
        }
    }
}
