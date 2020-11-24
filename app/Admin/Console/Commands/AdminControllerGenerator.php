<?php

namespace App\Admin\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminControllerGenerator extends CommonStubGenerator
{
    protected $signature = 'admin:controller {name : Class (singular) for example User}';

    protected $description = '创建新的控制器';

    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);

        $resourceName = Str::plural(strtolower(Str::snake($name, '-')));

        File::append(base_path('routes/admin.php'), 'Route::resource(\'' . $resourceName . "', '{$name}Controller');");

        $this->info('创建控制器成功');
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(admin_path("/Controllers/{$name}Controller.php"), $controllerTemplate);
    }
}
