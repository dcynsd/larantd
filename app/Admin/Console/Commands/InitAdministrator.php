<?php

namespace App\Admin\Console\Commands;

use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Admin\Models\AdminPermission;

class InitAdministrator extends Command
{
    protected $signature = 'admin:init-admin';

    protected $description = '初始化后台管理员';

    public function handle()
    {
        DB::table('admin_model_has_permission')->truncate();
        DB::table('admin_model_has_role')->truncate();
        AdminRole::truncate();
        AdminPermission::truncate();
        AdminUser::truncate();

        $permission = AdminPermission::create([
            'name' => '全部权限',
            'slug' => '*',
            'http_path' => '*',
        ]);

        AdminPermission::create([
            'name' => '角色权限管理',
            'slug' => 'manage-auth',
            'http_path' => "/admin-users*\n/admin-roles*\n/admin-permissions*\n/admin-menus*",
            'http_method' => ['GET', 'POST', 'DELETE', 'PUT'],
        ]);

        $role = AdminRole::create([
            'name' => '超级管理员',
            'slug' => 'administrator',
        ]);

        $role->permissions()->attach($permission);


        $user = AdminUser::create([
            'name' => 'Administrator',
            'avatar' => 'https://cdn.learnku.com/uploads/avatars/18572_1531721480.jpg!/both/100x100',
            'username' => 'admin',
            'password' => 'admin',
        ]);

        $user->roles()->attach($role);

        $this->info('初始化管理员成功');
    }
}
