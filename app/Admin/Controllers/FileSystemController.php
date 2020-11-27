<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Admin\Models\FileSystem;
use App\Admin\Resources\FileSystemResource;
use App\Admin\Utils\Handlers\ImageUploadHandler;

class FileSystemController extends Controller
{
    public function store(Request $request)
    {
        if (! $file = $request->file) {
            return $this->response->errorBadRequest('请上传文件');
        }

        $folder = $request->input('folder', 'common');

        $md5 = md5_file($file);

        if (! $fileSystem = FileSystem::whereMd5($md5)->first()) {
            if (! in_array($file->getMimeType(), FileSystem::$imageMimeTypeMap)) {
                return $this->response->errorBadRequest('暂只支持图片上传');
            }

            $result = app(ImageUploadHandler::class)->save($file, $folder, auth()->id());
            $fileSystem = FileSystem::create($result);
        }

        return $this->response->success(new FileSystemResource($fileSystem));
    }
}
