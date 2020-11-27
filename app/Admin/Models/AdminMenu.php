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
        return $this->morphToMany(AdminPermission::class, 'taggable', 'admin_model_has_permission');
    }

    public function roles()
    {
        return $this->morphToMany(AdminRole::class, 'taggable', 'admin_model_has_role');
    }

    public function parent()
    {
        return $this->belongsTo(AdminMenu::class);
    }

    public function children()
    {
        return $this->hasMany(AdminMenu::class, 'parent_id');
    }

    public function setRedirectAttribute($value)
    {
        if (! $value) {
            $this->attributes['redirect'] = '';
        } else {
            $this->attributes['redirect'] = $value;
        }
    }

    public function setIconAttribute($value)
    {
        if (! $value) {
            $this->attributes['icon'] = '';
        } else {
            $this->attributes['icon'] = $value;
        }
    }

    public function setPathAttribute($value)
    {
        if (!$value) {
            $this->attributes['path'] = '';
        } else {
            $this->attributes['path'] = $value;
        }
    }
}
