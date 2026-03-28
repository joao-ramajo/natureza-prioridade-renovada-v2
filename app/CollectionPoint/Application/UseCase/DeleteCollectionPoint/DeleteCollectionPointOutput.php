<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\DeleteCollectionPoint;

final readonly class DeleteCollectionPointOutput
{
    public function __construct(
        public string $message,
    ) {
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
