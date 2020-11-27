<?php

namespace App\Admin\Models;

use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Admin\Utils\Traits\HasPermission;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class AdminUser extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, HasPermission;

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

    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function permissions()
    {
        return $this->morphToMany(AdminPermission::class, 'taggable', 'admin_model_has_permission');
    }

    public function roles()
    {
        return $this->morphToMany(AdminRole::class, 'taggable', 'admin_model_has_role');
    }
}
