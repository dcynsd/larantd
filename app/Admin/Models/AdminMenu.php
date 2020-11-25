<?php

namespace App\Admin\Models;

class AdminMenu extends Model
{
    protected $fillable = [
        'parent_id', 'title', 'name', 'component', 'path', 'redirect',
        'icon', 'is_cache', 'is_show', 'order'
    ];

    protected $casts = [
        'is_cache' => 'boolean',
        'is_show' => 'boolean'
    ];

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'admin_model_has_permission');
    }

    public function roles()
    {
        return $this->morphToMany(AdminRole::class, 'admin_model_has_role');
    }
}
