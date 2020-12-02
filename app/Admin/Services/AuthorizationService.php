<?php

namespace App\Admin\Services;

use App\Admin\Models\AdminMenu;

class AuthorizationService
{
    public function getAuthMenus()
    {
        $menus = AdminMenu::orderByDesc('order')->get()->map(function (AdminMenu $adminMenu) {

            $data = [
                'id' => $adminMenu->id,
                'parentId' => $adminMenu->parent_id,
                'name' => $adminMenu->name,
                'component' => $adminMenu->component,
                'meta' => [
                    'icon' => $adminMenu->icon,
                    'title' => $adminMenu->title,
                    'show' => $adminMenu->is_show,
                ],
                'permission_hidden' => true,
            ];

            $adminMenu->redirect ? $data['redirect'] = $adminMenu->redirect : null;
            $adminMenu->path ? $data['path'] = $adminMenu->path : null;

            if ($this->hasPermission($adminMenu)) {
                $data['permission_hidden'] = false;
            }

            return $data;
        });

        $parentHide = $newMenus = $data = [];

        foreach ($menus as $menu) {
            if ($menu['permission_hidden']) {
                $parentHide[] = $menu['id'];
            } else {
                $newMenus[] = $menu;
            }
        }

        foreach ($newMenus as $menu) {
            if (! in_array($menu['parentId'], $parentHide)) {
                $data[] = $menu;
            }
        }

        return $data;
    }

    public function hasPermission(AdminMenu $adminMenu)
    {
        $permissions = $adminMenu->allPermissions();

        if ($permissions->isEmpty()) {
            return true;
        }

        foreach ($permissions as $permission) {
            if (auth()->user()->can($permission->slug)) {
                return true;
            }
        }

        return false;
    }
}
