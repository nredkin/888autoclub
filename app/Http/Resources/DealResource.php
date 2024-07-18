<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'deal_number' => $this->resource->deal_number,
            'deal_type' => $this->resource->deal_type,
            'client' => $this->resource->client_id,
            'car' => $this->resource->car_id,
            'security_deposit' => $this->resource->security_deposit,
            'contract_date' => $this->resource->contract_date->toDateString(),
            'rental_start' => $this->resource->rental_start ? Carbon::parse($this->resource->rental_start)->format('Y-m-d') : '',
            'rental_end' => $this->resource->rental_end ? Carbon::parse($this->resource->rental_end)->format('Y-m-d') : '',
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}
