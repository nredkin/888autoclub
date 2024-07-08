<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'               => $this->resource->email,
            'roleId'              => $this->resource->role_id,
            'role'                => User::getRoleName($this->resource->role_id),
            'is_active'           => $this->resource->is_active,
            'userable_type'       => $this->userable_type,
            'userable_id'         => $this->userable_id,
            'userable'            => $this->whenLoaded('userable', function() {
                return $this->isEmployee()
                    ? new EmployeeResource($this->userable)
                    : new ClientResource($this->userable);
            }),
        ];
    }
}
