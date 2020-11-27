<?php

namespace App\Admin\Models;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

    public function shouldPassThrough(Request $request): bool
    {
        if (empty($this->http_method) && empty($this->http_path)) {
            return true;
        }

        $method = $this->http_method;

        $matches = array_map(function ($path) use ($method) {
            $path = 'admin-api' . $path;

            if (Str::contains($path, ':')) {
                list($method, $path) = explode(':', $path);
                $method = explode(',', $method);
            }

            return compact('method', 'path');
        }, $this->http_path);

        foreach ($matches as $match) {
            if ($this->matchRequest($match, $request)) {
                return true;
            }
        }

        return false;
    }

    protected function matchRequest(array $match, Request $request): bool
    {
        if ($match['path'] == '/') {
            $path = '/';
        } else {
            $path = trim($match['path'], '/');
        }

        if (! $request->is($path)) {
            return false;
        }

        $method = collect($match['method'])->filter()->map(function ($method) {
            return strtoupper($method);
        });

        return $method->isEmpty() || $method->contains($request->method());
    }
}
