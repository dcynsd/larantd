<?php

namespace App\Admin\Models;

class FileSystem extends Model
{
    protected $fillable = [
        'filename', 'ext', 'path', 'size', 'mime_type', 'md5'
    ];

    public static $imageMimeTypeMap = [
        'image/png', 'image/jpg', 'image/jpeg', 'image/gif'
    ];

    public function getFullPathAttribute()
    {
        return config('app.url') . '/storage' . $this->attributes['path'];
    }
}
