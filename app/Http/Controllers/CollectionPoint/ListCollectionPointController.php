<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\GetColectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionPointResource;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class ListCollectionPointController extends Controller
{
    public function __construct(
        protected readonly GetColectionPointAction $getCollectionPointsAction
    ){}

    public function handle(Request $request)
    {
        $filters = $request->only([
            'search',
            'city',
            'state',
            'status',
            'category',
            'user_id',
        ]);

        $collectionPoints = $this->getCollectionPointsAction->execute(
            filters: $filters,
            perPage: $request->input('perPage'),
            page: $request->input('page')
        );

        return CollectionPointResource::collection($collectionPoints);
    }
}