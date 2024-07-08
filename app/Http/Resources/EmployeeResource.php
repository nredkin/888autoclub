<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'branchId'            => $this->resource->branch_id,
            'fullName'            => sprintf(
                '%s %s %s',
                $this->resource->last_name,
                $this->resource->first_name,
                $this->resource->middle_name
            ),

        ];
    }
}
