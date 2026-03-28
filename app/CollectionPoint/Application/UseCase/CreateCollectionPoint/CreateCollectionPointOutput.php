<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\CreateCollectionPoint;

final readonly class CreateCollectionPointOutput
{
    public function __construct(
        public string $message,
        public string $collectionPointId,
    ) {
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'collection_point_id' => $this->collectionPointId,
        ];
    }
}
