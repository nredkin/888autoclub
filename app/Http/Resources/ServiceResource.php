<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Use custom_price if available, otherwise fallback to servicePrices
        $price = $this->custom_price ?? $this->servicePrices->first()?->price;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'unit' => $this->unit,
            'with_driver' => $this->with_driver,
            'uniform_cost_for_cards' => $this->uniform_cost_for_cards,
            'is_active' => $this->is_active,
            'available_from_hours' => $this->available_from_hours,
            'available_to_hours' => $this->available_to_hours,
            'invoice_name' => $this->invoice_name,
            'price' => $price,
            'rental_start' => $this->rental_start,
            'rental_end' => $this->rental_end,
            'price_total' => $this->price_total,
        ];
    }
}
