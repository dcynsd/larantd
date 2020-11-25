<?php

namespace App\Admin\Models;

class AdminRole extends Model
{
    protected $fillable = ['name', 'slug'];

    protected $hidden = ['pivot'];

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'taggable', 'admin_model_has_permission');
    }
}
