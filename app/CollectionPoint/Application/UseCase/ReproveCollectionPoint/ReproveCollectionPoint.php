<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\ReproveCollectionPoint;

use App\CollectionPoint\Domain\CollectionPointStatus;
use App\CollectionPoint\Application\Event\CollectionPointReproved;
use App\CollectionPoint\Domain\CollectionPoint;

class ReproveCollectionPoint
{
    public function execute(CollectionPoint $collectionPoint, string $reason): void
    {
        $collectionPoint->update([
            'rejected_at' => now(),
            'rejection_reason' => $reason,
            'status' => CollectionPointStatus::REJECTED,
        ]);

        CollectionPointReproved::dispatch($collectionPoint, $reason);
    }
}
