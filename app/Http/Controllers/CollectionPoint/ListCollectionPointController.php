<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\IndexColectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionPointResource;
use Illuminate\Http\Request;

class ListCollectionPointController extends Controller
{
    public function __construct(
        protected readonly IndexColectionPointAction $indexCollectionPointsAction
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

        $collectionPoints = $this->indexCollectionPointsAction->execute(
            filters: $filters,
            perPage: $request->input('perPage'),
            page: $request->input('page')
        );

        return CollectionPointResource::collection($collectionPoints);
    }
}
