<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\IndexCollectionPoint\IndexCollectionPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListCollectionPointController extends Controller
{
    public function __construct(
        protected readonly IndexCollectionPoint $indexCollectionPoint
    ) {
    }

    public function __invoke(Request $request)
    {
        $filters = $request->only([
            'search',
            'city',
            'state',
            'status',
            'category',
            'user_id',
        ]);

        $collectionPoints = $this->indexCollectionPoint->execute(
            filters: $filters,
            perPage: $request->input('perPage'),
            page: $request->input('page')
        )->toArray();

        return response()
            ->json($collectionPoints);
    }
}
