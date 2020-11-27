<?php

namespace App\Admin\Models;

use Illuminate\Support\Str;
use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Route;
use App\Admin\Utils\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use DefaultDatetimeFormat, HasFactory, Filterable;

    public function syncRoleAndPermission($eloquent = null)
    {
        $model = $eloquent ?: $this;

        if (! Str::startsWith(Route::currentRouteName(), 'admin.admin-roles')) {
            $roles = request()->input('roles', []);
            $roles = AdminRole::whereIn('id', $roles)->get();
            $model->roles()->sync($roles);
        }

        $permissions = request()->input('permissions', []);
        $permissions = AdminPermission::whereIn('id', $permissions)->get();
        $model->permissions()->sync($permissions);
    }
}
