<?php

namespace App\Admin\Models;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class AdminUser extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $fillable = ['name', 'avatar', 'username', 'password'];

    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'admin_model_has_permission');
    }

    public function roles()
    {
        return $this->morphToMany(AdminRole::class, 'admin_model_has_role');
    }
}