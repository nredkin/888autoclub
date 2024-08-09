<?php

namespace App\Http\Resources;

use App\Models\Branch;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Car $resource */
class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->resource->id,
            'model'          => $this->resource->model,
            'vin'            => $this->resource->vin,
            'year'           => $this->resource->year,
            'engine_model'   => $this->resource->engine_model,
            'engine_power'   => $this->resource->engine_power,
            'color_id'       => $this->resource->color_id,
            'cost'           => $this->resource->cost,
            'branch_id'      => $this->resource->branch_id,
            'registration_series' => $this->resource->registration_series,
            'registration_number' => $this->resource->registration_number,
            'pts_number'     => $this->resource->pts_number,
            'pts_date'       => $this->resource->pts_date ? Carbon::parse($this->resource->pts_date)->format('Y-m-d') : '',
            'reg_sign'       => $this->resource->reg_sign,
            'description'    => $this->resource->description,
            'act_file_id'    => $this->resource->act_file_id,
        ];
    }
}
