<?php

namespace App\Admin\Middleware;

use Closure;
use App\Admin\Utils\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Admin\Utils\PermissionChecker;

class AdminPermission
{
    protected $middlewarePrefix = 'admin.permission:';

    public function handle(Request $request, Closure $next, ...$args)
    {
        if (! Admin::user() || !empty($args) || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        if ($this->checkRoutePermission($request)) {
            return $next($request);
        }

        if (! Admin::user()->allPermissions()->first(function ($permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            PermissionChecker::error();
        }

        return $next($request);
    }

    public function checkRoutePermission(Request $request)
    {
        if (! $middleware = collect($request->route()->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (! method_exists(PermissionChecker::class, $method)) {
            throw new \InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func_array([PermissionChecker::class, $method], [$args]);

        return true;
    }

    protected function shouldPassThrough($request)
    {
        // 下面这些路由不验证权限
        $excepts = [
            'authorizations/me',
            'authorizations/menus',
            'authorizations'
        ];

        return collect($excepts)
            ->map('admin_base_path')
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }

                return $request->is($except);
            });
    }
}
