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
            'deal_type' => $this->resource->deal_type,
            'user_id' => $this->resource->user_id,
            'car_id' => $this->resource->car_id,
            'branch_id' => $this->resource->branch_id,
            'security_deposit' => $this->resource->security_deposit,
            'contract_date' => $this->resource->contract_date ? Carbon::parse($this->resource->contract_date)->format('Y-m-d') : '',
            'rental_start' => $this->resource->rental_start ? Carbon::parse($this->resource->rental_start)->format('Y-m-d H:i') : '',
            'rental_end' => $this->resource->rental_end ? Carbon::parse($this->resource->rental_end)->format('Y-m-d H:i') : '',
            'comment' => $this->resource->commit,
        ];
    }
}
