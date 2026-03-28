<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\IndexCollectionPoint;

use Illuminate\Http\Request;

final readonly class IndexCollectionPointInput
{
    public function __construct(
        public array $filters = [],
        public int $perPage = 15,
        public int $page = 1,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $filters = $request->only([
            'search',
            'city',
            'state',
            'status',
            'category',
            'user_id',
        ]);

        return new self(
            filters: $filters,
            perPage: (int) $request->integer('perPage', 15),
            page: (int) $request->integer('page', 1),
        );
    }
}
