<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\Contract;

use App\CollectionPoint\Application\DataTransferObject\GeocodedLocation;

interface CollectionPointGeocoder
{
    public function geocode(string $address): ?GeocodedLocation;
}
