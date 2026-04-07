<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\DataTransferObject;

final readonly class GeocodedLocation
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {
    }
}
