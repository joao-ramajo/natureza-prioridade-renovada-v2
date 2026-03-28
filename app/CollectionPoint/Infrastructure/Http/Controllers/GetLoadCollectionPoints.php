<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\LoadCollectionPoint\LoadCollectionPoint;
use App\CollectionPoint\Application\UseCase\LoadCollectionPoint\LoadCollectionPointInput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetLoadCollectionPoints extends Controller
{
    public function __construct(
        protected readonly LoadCollectionPoint $loadCollectionPoint
    ) {
    }

    public function __invoke(Request $request)
    {
        $output = $this->loadCollectionPoint->execute(LoadCollectionPointInput::fromRequest($request));

        return response()
            ->json($output->toArray());
    }
}
