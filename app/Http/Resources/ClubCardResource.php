<?php

namespace App\Http\Resources;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Branch $resource */
class ClubCardResource extends JsonResource
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
            'client_id'       => $this->resource->client_id,
            'club_card_level_id' => $this->resource->club_card_level_id,
            'is_active'       => $this->resource->is_active,
        ];
    }
}
