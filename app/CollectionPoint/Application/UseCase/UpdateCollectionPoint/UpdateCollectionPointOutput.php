<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\UpdateCollectionPoint;

use App\CollectionPoint\Application\Mapper\CollectionPointMapper;
use App\CollectionPoint\Domain\Entity\CollectionPoint;

final readonly class UpdateCollectionPointOutput
{
    public function __construct(
        public array $data,
    ) {
    }

    public static function fromEntity(CollectionPoint $collectionPoint): self
    {
        return new self(
            data: CollectionPointMapper::toArray($collectionPoint),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
        ];
    }
}
