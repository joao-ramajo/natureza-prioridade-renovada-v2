<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\CollectionPoint $resource
 */
class CollectionPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->uuid,
            'name' => $this->resource->name,
            'category' => $this->resource->category,
            'status' => $this->resource->status,
            'address' => $this->resource->address,
            'city' => $this->resource->city,
            'state' => $this->resource->state,
            'lat' => $this->resource->lat,
            'lng' => $this->resource->lng,
            'created_by' => $this->resource->relationLoaded('user')
                    ? [
                        'name'  => $this->resource->user->name,
                        'email' => $this->resource->user->email,
                    ]
                    : null,
            'created_at' => $this->resource->created_at->toISOString(),
            'updated_at' => $this->resource->updated_at->toISOString(),
        ];
    }
}
