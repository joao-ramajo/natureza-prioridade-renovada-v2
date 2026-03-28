<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use App\CollectionPoint\Infrastructure\Http\Resources\CollectionPointResource;

class GetCollectionPointController extends Controller
{
    public function __construct(
        protected readonly FindCollectionPoint $findCollectionPoint
    ) {
    }

    public function __invoke(string $uuid)
    {
        $cp = $this->findCollectionPoint->execute($uuid);

        if (!$cp) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.'
            ], 404);
        }

        return new CollectionPointResource($cp);
    }
}
