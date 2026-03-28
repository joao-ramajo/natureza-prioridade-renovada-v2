<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\IndexCollectionPoint;

final readonly class IndexCollectionPointOutput
{
    public function __construct(
        public array $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload;
    }
}
