<?php

namespace App\Admin\Console\Commands;

class AdminRequestGenerator extends CommonStubGenerator
{
    protected $signature = 'admin:request {name : Class (singular) for example User}';

    protected $description = '创建新的验证';

    public function handle()
    {
        $name = $this->argument('name');

        $this->request($name);

        $this->info('创建验证成功');
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        file_put_contents(admin_path("/Requests/{$name}Request.php"), $requestTemplate);
    }
}
