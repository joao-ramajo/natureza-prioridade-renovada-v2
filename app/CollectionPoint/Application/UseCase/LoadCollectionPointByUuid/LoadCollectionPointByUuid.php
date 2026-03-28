<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPointByUuid;

use App\CollectionPoint\Application\Mapper\CollectionPointMapper;
use App\CollectionPoint\Domain\Entity\CollectionPoint;

class LoadCollectionPointByUuid
{
    public function __construct(
        protected readonly CollectionPointMapper $collectionPointMapper,
    ) {
    }

    public function execute(LoadCollectionPointByUuidInput $input): ?LoadCollectionPointByUuidOutput
    {
        $cp = CollectionPoint::where('uuid', $input->uuid)->with('user:id,name,email')->first();

        if (!$cp) {
            return null;
        }

        if ($input->withImages) {
            $cp->load(['images']);
        }

        return new LoadCollectionPointByUuidOutput(
            data: $this->collectionPointMapper->fromEntity($cp),
        );
    }
}
