<?php

namespace App\Admin\Models;

class AdminRole extends Model
{
    protected $fillable = ['name', 'slug'];

    protected $hidden = ['pivot'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->permissions()->detach();
        });
    }

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'taggable', 'admin_model_has_permission');
    }
}
