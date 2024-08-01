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
            'user' => new UserResource($this->whenLoaded('user')),
            'car_id' => $this->car_id,
            'car' => new CarResource($this->whenLoaded('car')),
            'branch_id' => $this->branch_id,
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'dead_id' => $this->deal_id,
            'deal' => new DealResource($this->whenLoaded('deal')),
            'expense_item_id' => $this->expense_item_id,
            'expense_item' => new ExpenseItemResource($this->whenLoaded('expense_item')),
            'sum' => $this->sum,
            'type' => $this->type,
            'client_balance_change' => $this->client_balance_change,
        ];
    }
}
