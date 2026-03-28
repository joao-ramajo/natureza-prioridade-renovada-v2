<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\LoadCollectionPoint;

use Illuminate\Http\Request;

final readonly class LoadCollectionPointInput
{
    public function __construct(
        public array $filters = [],
        public bool $all = false,
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
            all: $request->boolean('all'),
            perPage: (int) $request->integer('perPage', 15),
            page: (int) $request->integer('page', 1),
        );
    }
}
