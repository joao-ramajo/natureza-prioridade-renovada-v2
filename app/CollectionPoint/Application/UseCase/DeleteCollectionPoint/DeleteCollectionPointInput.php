<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\DeleteCollectionPoint;

final readonly class DeleteCollectionPointInput
{
    public function __construct(
        public string $uuid,
        public int $userId,
    ) {
    }
}
