<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint;

final readonly class GeolocateCollectionPointInput
{
    public function __construct(
        public int $collectionPointId,
    ) {
    }
}
