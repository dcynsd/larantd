<?php

namespace App\Admin\Requests;

use Illuminate\Validation\Rule;
use App\Admin\Models\AdminPermission;

class AdminPermissionRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'slug' => 'required|unique:admin_permissions',
                    'http_method' => 'nullable|array',
                    'http_method.*' => Rule::in(AdminPermission::$httpMethods),
                    'http_path' => 'nullable|string',
                ];
            case 'PUT':
                $model = $this->route('admin_permission');
                return [
                    'name' => 'required',
                    'slug' => 'required|unique:admin_permissions,slug,'.$model->id,
                    'http_method' => 'nullable|array',
                    'http_method.*' => Rule::in(AdminPermission::$httpMethods),
                    'http_path' => 'nullable|string',
                ];
        }
    }
}
