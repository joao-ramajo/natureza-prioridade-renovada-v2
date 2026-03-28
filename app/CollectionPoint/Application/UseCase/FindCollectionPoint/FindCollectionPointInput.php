<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\FindCollectionPoint;

final readonly class FindCollectionPointInput
{
    public function __construct(
        public string $uuid,
        public bool $withImages = true,
    ) {
    }
}
