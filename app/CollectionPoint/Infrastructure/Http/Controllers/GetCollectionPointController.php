<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPoint;
use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPointInput;
use App\Http\Controllers\Controller;

class GetCollectionPointController extends Controller
{
    public function __construct(
        protected readonly FindCollectionPoint $findCollectionPoint
    ) {
    }

    public function __invoke(string $uuid)
    {
        $output = $this->findCollectionPoint->execute(new FindCollectionPointInput($uuid));

        if (!$output) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.'
            ], 404);
        }

        return response()->json($output->toArray());
    }
}
