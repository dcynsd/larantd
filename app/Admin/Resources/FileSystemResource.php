<?php

namespace App\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileSystemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'ext' => $this->ext,
            'path' => $this->path,
            'full_path' => $this->full_path,
            'mime_type' => $this->mime_type,
        ];
    }
}
