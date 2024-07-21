<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'user_id' => $this->user_id,
            'car_id' => $this->car_id,
            'branch_id' => $this->branch_id,
            'sum' => $this->sum,
            'type' => $this->type,
            'client_balance_change' => $this->client_balance_change,
        ];
    }
}
