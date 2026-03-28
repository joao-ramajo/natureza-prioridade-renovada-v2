<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\IndexCollectionPoint;

use App\CollectionPoint\Domain\Entity\CollectionPoint;

class IndexCollectionPoint
{
    public function execute(IndexCollectionPointInput $input): IndexCollectionPointOutput
    {
        $filters = $input->filters;
        $query = CollectionPoint::query();

        $query->with('user');

        if (!empty($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['state'])) {
            $query->where('state', $filters['state']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['category'])) {
            $categories = is_array($filters['category'])
                ? $filters['category']
                : [$filters['category']];

            $query->whereIn('category', $categories);
        }

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        $result = $query
            ->orderByDesc('created_at')
            ->paginate(
                perPage: $input->perPage,
                page: $input->page
            );

        return new IndexCollectionPointOutput($result->toArray());
    }
}
