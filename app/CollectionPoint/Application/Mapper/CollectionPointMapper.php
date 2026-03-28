<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\Mapper;

use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\CollectionPoint\Domain\Entity\CollectionPointStatus;

final class CollectionPointMapper
{
    public function fromEntity(CollectionPoint $collectionPoint): array
    {
        $status = $collectionPoint->status;

        $data = [
            'id' => $collectionPoint->uuid,
            'name' => $collectionPoint->name,
            'principal_image' => $collectionPoint->principal_image,
            'category' => $collectionPoint->category,
            'status' => $status instanceof CollectionPointStatus ? $status->value : $status,
            'address' => $collectionPoint->address,
            'city' => $collectionPoint->city,
            'state' => $collectionPoint->state,
            'lat' => $collectionPoint->lat,
            'lng' => $collectionPoint->lng,
            'created_by' => $collectionPoint->relationLoaded('user')
                ? [
                    'name' => (string) $collectionPoint->user->name,
                    'email' => (string) $collectionPoint->user->email,
                ]
                : null,
            'created_at' => $collectionPoint->created_at?->toISOString(),
            'updated_at' => $collectionPoint->updated_at?->toISOString(),
        ];

        if ($collectionPoint->relationLoaded('images')) {
            $data['images'] = $collectionPoint->images->map(static fn ($image) => [
                'id' => $image->id,
                'image_path' => $image->image_path,
                'image_url' => $image->image_url,
                'created_at' => $image->created_at?->toISOString(),
                'updated_at' => $image->updated_at?->toISOString(),
            ])->all();
        }

        return $data;
    }
}
