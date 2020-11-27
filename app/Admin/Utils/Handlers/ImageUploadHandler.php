<?php

namespace App\Admin\Utils\Handlers;

use  Illuminate\Support\Str;

class ImageUploadHandler
{
    public function save($file, $folder, $filePrefix)
    {
        $folderName = "uploads/images/$folder/" . date("Ym/d", time());

        $uploadPath = storage_path('app/public') . '/' . $folderName;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $filePrefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        $result = [
            'filename' => $filename,
            'ext' => $extension,
            'path' => "/$folderName/$filename",
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'md5' => md5_file($file)
        ];

        $file->move($uploadPath, $filename);

        return $result;
    }
}
