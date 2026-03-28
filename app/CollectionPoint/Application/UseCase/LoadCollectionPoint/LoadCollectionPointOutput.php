<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPoint;

final readonly class LoadCollectionPointOutput
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
