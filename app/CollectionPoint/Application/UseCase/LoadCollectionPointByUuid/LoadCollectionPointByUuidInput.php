<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPointByUuid;

final readonly class LoadCollectionPointByUuidInput
{
    public function __construct(
        public string $uuid,
        public bool $withImages = true,
    ) {
    }
}
