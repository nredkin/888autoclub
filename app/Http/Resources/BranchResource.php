<?php

namespace App\Http\Resources;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Branch $resource */
class BranchResource extends JsonResource
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
            'name'            => $this->resource->name,
            'address'         => $this->resource->address,
            'wa_token'        => $this->resource->wa_token,
        ];
    }
}
