<?php declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Models\CollectionPoint;

class IndexColectionPointAction
{
    public function execute(
        array $filters,
        ?int $perPage = 15,
        ?int $page = 1,
    ) {
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

        return $query
            ->orderByDesc('created_at')
            ->paginate(
                perPage: $perPage,
                page: $page
            );
    }
}
