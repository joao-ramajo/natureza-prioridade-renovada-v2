<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Models\CollectionPoint;

class FindCollectionPoint
{
    public function execute(string $uuid): ?CollectionPoint
    {
        return CollectionPoint::where('uuid', $uuid)->with('user:id,name,email', 'images')->first();
    }
}
