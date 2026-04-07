<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint;

use App\CollectionPoint\Application\Contract\CollectionPointGeocoder;
use App\CollectionPoint\Domain\Entity\CollectionPoint;

final class GeolocateCollectionPoint
{
    public function __construct(
        protected readonly CollectionPointGeocoder $collectionPointGeocoder,
    ) {
    }

    public function execute(GeolocateCollectionPointInput $input): void
    {
        $collectionPoint = CollectionPoint::query()->find($input->collectionPointId);

        if ($collectionPoint === null) {
            return;
        }

        $location = $this->collectionPointGeocoder->geocode(
            $this->buildAddress($collectionPoint)
        );

        if ($location === null) {
            return;
        }

        $collectionPoint->update([
            'lat' => $location->latitude,
            'lng' => $location->longitude,
        ]);
    }

    private function buildAddress(CollectionPoint $collectionPoint): string
    {
        return implode(', ', array_filter([
            $collectionPoint->address,
            $collectionPoint->city,
            $collectionPoint->state,
            $collectionPoint->zip_code,
            'Brasil',
        ]));
    }
}
