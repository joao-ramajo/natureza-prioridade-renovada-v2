<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPointByUuid;

final readonly class LoadCollectionPointByUuidOutput
{
    public function __construct(
        public array $data,
    ) {
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
        ];
    }
}
