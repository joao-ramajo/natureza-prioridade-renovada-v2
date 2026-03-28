<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\IndexCollectionPoint\IndexCollectionPoint;
use App\CollectionPoint\Application\UseCase\IndexCollectionPoint\IndexCollectionPointInput;
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
        $output = $this->indexCollectionPoint->execute(IndexCollectionPointInput::fromRequest($request));

        return response()
            ->json($output->toArray());
    }
}
