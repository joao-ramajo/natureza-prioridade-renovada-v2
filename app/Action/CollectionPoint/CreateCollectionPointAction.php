<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointCreated;
use App\Models\CollectionPoint;

class CreateCollectionPointAction
{
    public function execute(array $data): CollectionPoint
    {
        $data['status'] = CollectionPointStatus::PENDING;

        $cp = CollectionPoint::create($data);

        CollectionPointCreated::dispatch($cp);

        return $cp;
    }
}
