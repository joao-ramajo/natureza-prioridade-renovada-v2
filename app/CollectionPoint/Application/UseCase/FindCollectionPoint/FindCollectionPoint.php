<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\FindCollectionPoint;

use App\CollectionPoint\Domain\Entity\CollectionPoint;

class FindCollectionPoint
{
    public function execute(FindCollectionPointInput $input): ?FindCollectionPointOutput
    {
        $cp = CollectionPoint::where('uuid', $input->uuid)->with('user:id,name,email')->first();

        if (!$cp) {
            return null;
        }

        if ($input->withImages) {
            $cp->load(['images']);
        }

        return FindCollectionPointOutput::fromEntity($cp);
    }
}
