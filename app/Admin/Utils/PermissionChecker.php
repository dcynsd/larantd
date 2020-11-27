<?php

namespace App\Admin\Utils;

class PermissionChecker
{
    public static function check($permission)
    {
        if (static::isAdministrator()) {
            return true;
        }

        if (is_array($permission)) {
            collect($permission)->each(function ($permission) {
                call_user_func([self::class, 'check'], $permission);
            });

            return;
        }

        if (Admin::user()->cannot($permission)) {
            static::error();
        }
    }

    public static function error()
    {
        abort(403, '没有权限');
    }

    public static function isAdministrator()
    {
        return Admin::user()->isRole('administrator');
    }
}
