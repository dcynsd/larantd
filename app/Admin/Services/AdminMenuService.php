<?php

namespace App\Admin\Services;

use App\Admin\Models\AdminMenu;

class AdminMenuService
{
    public function getMenuTree($parentId = null, $menus = null)
    {
        if (is_null($menus)) {
            $menus = AdminMenu::with('permissions:id,name', 'roles:id,name')
                ->orderBy('order')
                ->get();
        }

        $all = $menus
            ->where('parent_id', $parentId)
            ->map(function (AdminMenu $adminMenu) use ($menus) {
                $data = $adminMenu->toArray();

                if (! count($adminMenu->children)) {
                    return $data;
                }

                $children = $this->getMenuTree($adminMenu->id, $menus);
                $data['children'] = array_values($children);

                return $data;
            });

        return array_values($all->toArray());
    }

    public function makeOptionsTree($adminMenus = null, $parentId = 0, $level = 0)
    {
        if (is_null($adminMenus)) {
            $adminMenus = AdminMenu::select(['id', 'parent_id', 'title'])->orderBy('order')->get();
        }

        static $newData = [];

        foreach ($adminMenus as $key => $adminMenu) {
            if ($adminMenu['parent_id'] == $parentId) {
                $adminMenu['level'] = $level;
                $newData[] = $adminMenu;
                unset($adminMenu[$key]);
                $this->makeOptionsTree($adminMenus, $adminMenu['id'], $level + 1);
            }
        }

        return $newData;
    }
}
