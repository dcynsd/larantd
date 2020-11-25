<?php

namespace App\Admin\Models;

class AdminRole extends Model
{
    protected $fillable = ['name', 'slug'];

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'admin_model_has_permission');
    }
}
