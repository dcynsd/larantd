<?php

namespace App\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminServiceProvider extends ServiceProvider
{
    protected $middlewareMap = [

    ];

    protected $middlewareGroups = [
        'admin' => [
            \App\Admin\Middleware\AcceptHeader::class,
            \App\Admin\Middleware\SetAuthGuard::class,
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $commands = [
        \App\Admin\Console\Commands\AdminControllerGenerator::class,
        \App\Admin\Console\Commands\AdminModelGenerator::class,
        \App\Admin\Console\Commands\AdminRequestGenerator::class,
        \App\Admin\Console\Commands\AdminResourceGenerator::class,
        \App\Admin\Console\Commands\InitAdministrator::class,
    ];

    public function boot()
    {
        foreach ($this->middlewareMap as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }

        $this->mapAdminRoutes();

        JsonResource::withoutWrapping();
    }

    public function register()
    {
        $this->commands($this->commands);
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('admin')
            ->namespace('App\Admin\Controllers')
            ->group(base_path('routes/admin.php'));
    }
}
