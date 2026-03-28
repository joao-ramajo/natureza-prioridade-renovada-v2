<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPoint;
use App\CollectionPoint\Application\UseCase\ReproveCollectionPoint\ReproveCollectionPoint;
use App\Http\Controllers\Controller;
use App\CollectionPoint\Infrastructure\Http\Requests\ReproveCollectionPointRequest;
use Illuminate\Http\JsonResponse;
class ReproveCollectionPointController extends Controller
{
    public function __construct(
        protected readonly ReproveCollectionPoint $reproveCollectionPoint,
        protected readonly FindCollectionPoint $findCollectionPoint,
    ) {
    }

    public function __invoke(ReproveCollectionPointRequest $request, string $uuid): JsonResponse
    {
        $collectionPoint = $this->findCollectionPoint->execute(
            uuid: $uuid,
            withImages: false
        );

        $this->reproveCollectionPoint->execute(
            collectionPoint: $collectionPoint,
            reason: $request->input('reason')
        );

        return response()->json([
            'message' => 'Ponto de coleta reprovado com sucesso.'
        ], 200);
    }
}
