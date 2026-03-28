<?php

declare(strict_types=1);

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\ApproveCollectionPoint\ApproveCollectionPoint;
use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use App\CollectionPoint\Infrastructure\Http\Resources\CollectionPointResource;
class ApproveCollectionPointController extends Controller
{
    public function __construct(
        protected readonly ApproveCollectionPoint $approveCollectionPoint,
        protected readonly FindCollectionPoint $findCollectionPoint,
    ) {
    }

    public function __invoke(string $uuid)
    {
        $collectionPoint = $this->findCollectionPoint->execute(
            uuid: $uuid,
            withImages: false
        );

        if (!$collectionPoint) {
            return response()->json([
                'message' => 'Ponto não encontrado'
            ], 404);
        }

        $this->approveCollectionPoint->execute(collectionPoint: $collectionPoint);

        return response()->json([
            'message' => 'Ponto de coleta aprovado.',
            'data' => new CollectionPointResource($collectionPoint)
        ], 200);
    }
}
