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

        // 定义静态变量，防止每次都初始化
        static $newData = [];

        // 循环，得出每个数据对应的层级
        foreach ($adminMenus as $key => $adminMenu) {
            // 第一次遍历，找到父节点为根节点的节点，即：pid = 0
            if ($adminMenu['parent_id'] == $parentId) {
                // 当该节点为根节点时，对应的层级设为 0，即：level = 0
                $adminMenu['level'] = $level;
                // 把该节点放入数组中
                $newData[] = $adminMenu;
                // 得出节点层级后，删除该节点，减少递归的消耗
                unset($adminMenu[$key]);
                // 开始递归，查找所有 pid 为当前节点 id 的数据，层级加 1，作为对应的子节点
                $this->makeOptionsTree($adminMenus, $adminMenu['id'], $level + 1);
            }
        }

        // 返回带层级的新数组
        return $newData;
    }
}
