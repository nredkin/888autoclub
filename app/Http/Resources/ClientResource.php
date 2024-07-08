<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->resource->id,
            'firstName'           => $this->resource->first_name,
            'middleName'          => $this->resource->middle_name,
            'lastName'            => $this->resource->last_name,
            'categoryIds'  => $this->resource->category_ids, // Include category IDs
          //  'categories'   => CategoryResource::collection($this->whenLoaded('categories')),
            'fullName'            => sprintf(
                '%s %s %s',
                $this->resource->last_name,
                $this->resource->first_name,
                $this->resource->middle_name
            ),

        ];
    }
}
