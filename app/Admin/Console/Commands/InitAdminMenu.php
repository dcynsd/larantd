<?php

namespace App\Admin\Console\Commands;

use App\Admin\Models\AdminMenu;
use Illuminate\Console\Command;

class InitAdminMenu extends Command
{
    protected $signature = 'admin:init-admin-menu';

    protected $description = '初始化后台菜单';

    public function handle()
    {
        AdminMenu::truncate();

        $data = [
            [
                'parent_id' => 0,
                'name' => 'dashboard',
                'title' => '仪表盘',
                'icon' => 'dashboard',
                'component' => 'RouteView',
                'redirect' => '/dashboard/workplace',
                'path' => '',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 1,
                'name' => 'Workplace',
                'title' => '工作台',
                'icon' => '',
                'component' => 'Workplace',
                'redirect' => '',
                'path' => '/dashboard/workplace',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 1,
                'name' => 'Analysis',
                'title' => '分析页',
                'icon' => '',
                'component' => 'Analysis',
                'redirect' => '',
                'path' => '/dashboard/analysis',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 0,
                'name' => 'setting',
                'title' => '系统管理',
                'icon' => 'setting',
                'component' => 'RouteView',
                'redirect' => '/setting/admin-users',
                'path' => '',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'name' => 'AdminUserList',
                'title' => '管理员',
                'icon' => '',
                'component' => 'AdminUserList',
                'redirect' => '',
                'path' => '/setting/admin-users',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'name' => 'AdminPermissionList',
                'title' => '权限',
                'icon' => '',
                'component' => 'AdminPermissionList',
                'redirect' => '',
                'path' => '/setting/admin-permissions',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'name' => 'AdminRoleList',
                'title' => '角色',
                'icon' => '',
                'component' => 'AdminRoleList',
                'redirect' => '',
                'path' => '/setting/admin-roles',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 4,
                'name' => 'AdminMenuList',
                'title' => '菜单',
                'icon' => '',
                'component' => 'AdminMenuList',
                'redirect' => '',
                'path' => '/setting/admin-menus',
                'order' => 0,
                'is_show' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        AdminMenu::insert($data);

        $this->info('初始化后台菜单成功');
    }
}
