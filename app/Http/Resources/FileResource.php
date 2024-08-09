<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->resource->id,
            'filename'        => $this->resource->filename,
            'path'            => $this->resource->path,
            'filesize'        => $this->resource->filesize,
            'is_special'      => $this->resource->is_special,
            'created_at'      => $this->resource->created_at ? Carbon::parse($this->resource->created_at)->format('Y-m-d') : '',
        ];
    }
}
