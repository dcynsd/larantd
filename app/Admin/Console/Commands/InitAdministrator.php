<?php

namespace App\Admin\Console\Commands;

use App\Admin\Models\AdminUser;
use Illuminate\Console\Command;

class InitAdministrator extends Command
{
    protected $signature = 'admin:init-admin';

    protected $description = '初始化后台管理员';

    public function handle()
    {
        AdminUser::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('admin'),
            ]
        );

        $this->info('初始化管理员成功');
    }
}
