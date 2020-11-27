<?php

namespace App\Admin\Utils;

use Illuminate\Support\Facades\Auth;

class Admin
{
    public static function user()
    {
        return Auth::guard('admin')->user();
    }

    public static function isAdministrator()
    {
        return static::user() && static::user()->isAdministrator();
    }
}
