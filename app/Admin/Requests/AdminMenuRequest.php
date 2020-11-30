<?php

namespace App\Admin\Requests;

class AdminMenuRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'parent_id' => 'required',
                    'name' => 'required|unique:admin_menus',
                    'title' => 'required',
                    'component' => 'required',
                ];
            case 'PUT':
                $model = $this->route('admin_menu');
                return [
                    'parent_id' => 'required',
                    'name' => 'required|unique:admin_menus,name,' . $model->id,
                    'title' => 'required',
                    'component' => 'required',
                ];
        }
    }

    public function attributes()
    {
        return [
            'parent_id' => '父级ID',
            'name' => '菜单标识',
            'title' => '菜单标题',
            'component' => '组件名称',
        ];
    }
}
