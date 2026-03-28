<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPoint;

use App\CollectionPoint\Application\Mapper\CollectionPointMapper;
use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\CollectionPoint\Domain\Entity\CollectionPointStatus;

class LoadCollectionPoint
{
    public function __construct(
        protected readonly CollectionPointMapper $collectionPointMapper,
    ) {
    }

    public function execute(LoadCollectionPointInput $input): LoadCollectionPointOutput
    {
        $filters = $input->filters;
        $query = CollectionPoint::query()->with('user');

        foreach (['city', 'state', 'user_id'] as $field) {
            $query->when(
                !empty($filters[$field]),
                fn ($query) => $query->where($field, $filters[$field]),
            );
        }

        $query->when(
            !$input->all,
            fn ($query) => $query->where('status', CollectionPointStatus::ACTIVE),
            fn ($query) => $query->when(
                !empty($filters['status']),
                fn ($query) => $query->where('status', $filters['status']),
            ),
        );

        $query->when(
            !empty($filters['search']),
            fn ($query) => $query->where('name', 'like', "%{$filters['search']}%"),
        );

        $query->when(
            !empty($filters['category']),
            fn ($query) => $query->whereIn(
                'category',
                is_array($filters['category']) ? $filters['category'] : [$filters['category']],
            ),
        );

        $result = $query
            ->orderByDesc('created_at')
            ->paginate(
                perPage: $input->perPage,
                page: $input->page
            );

        $result->setCollection(
            $result->getCollection()->map(
                fn (CollectionPoint $collectionPoint) => $this->collectionPointMapper->fromEntity($collectionPoint),
            ),
        );

        return new LoadCollectionPointOutput($result->toArray());
    }
}
