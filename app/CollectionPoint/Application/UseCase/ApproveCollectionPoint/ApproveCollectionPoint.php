<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\ApproveCollectionPoint;

use App\CollectionPoint\Domain\CollectionPointStatus;
use App\CollectionPoint\Application\Event\CollectionPointApproved;
use App\CollectionPoint\Domain\CollectionPoint;

class ApproveCollectionPoint
{
    public function execute(CollectionPoint $collectionPoint): void
    {
        $collectionPoint->update([
            'status' => CollectionPointStatus::APPROVED,
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);

        CollectionPointApproved::dispatch($collectionPoint);
    }
}
