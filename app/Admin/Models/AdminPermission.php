<?php

namespace App\Admin\Models;

class AdminPermission extends Model
{
    protected $fillable = ['name', 'slug', 'http_method', 'http_path'];

    protected $casts = [
        'http_method' => 'json',
        'http_path' => 'json'
    ];

    protected $hidden = ['pivot'];

    public static $httpMethods = [
        'GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD',
    ];

    public function setHttpMethodAttribute($httpMethod)
    {
        $this->attributes['http_method'] = collect($httpMethod)
            ->reject(function ($item) {
                return is_null($item);
            });
    }

    public function setHttpPathAttribute($httpPath)
    {
        $httpPath = explode("\n", $httpPath) ?: null;
        $this->attributes['http_path'] = json_encode($httpPath);
    }
}
