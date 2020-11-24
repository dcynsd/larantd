<?php

namespace App\Admin\Console\Commands;

class AdminResourceGenerator extends CommonStubGenerator
{
    protected $signature = 'admin:resource {name : Class (singular) for example User}';

    protected $description = '创建新的资源';

    public function handle()
    {
        $name = $this->argument('name');

        $this->resource($name);

        $this->info('创建资源成功');
    }

    protected function resource($name)
    {
        $resourceTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Resource')
        );

        file_put_contents(admin_path("/Resources/{$name}Resource.php"), $resourceTemplate);
    }
}
