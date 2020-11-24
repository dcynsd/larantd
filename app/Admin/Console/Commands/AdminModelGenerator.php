<?php

namespace App\Admin\Console\Commands;

use Illuminate\Support\Str;

class AdminModelGenerator extends CommonStubGenerator
{
    protected $signature = 'admin:model
        {name : Class (singular) for example User}
        {--m : 是否同时添加迁移文件}
    ';

    protected $description = '创建新的模型';

    public function handle()
    {
        $name = $this->argument('name');

        $this->model($name);

        if ($this->option('m')) {
            $this->migration($name);
        }

        $this->info('创建模型成功');
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(admin_path("/Models/{$name}.php"), $modelTemplate);
    }

    protected function migration($name)
    {
        $tableName = Str::plural(strtolower(Str::snake($name)));

        $className = Str::studly($tableName);

        $migrationTemplate = str_replace(
            ['{{modelName}}', '{{tableName}}'],
            [$className, $tableName],
            $this->getStub('Migration')
        );

        $migrationName = now()->format('Y_m_d_hms_') . "create_{$tableName}_table";

        file_put_contents(base_path("/database/migrations/{$migrationName}.php"), $migrationTemplate);
    }
}
