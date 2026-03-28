<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\UpdateCollectionPoint\UpdateCollectionPoint;
use App\Http\Controllers\Controller;
use App\CollectionPoint\Infrastructure\Http\Requests\UpdateCollectionPointRequest;
use App\CollectionPoint\Infrastructure\Http\Resources\CollectionPointResource;
use Illuminate\Support\Facades\Auth;

class UpdateCollectionPointController extends Controller
{
    public function __construct(
        protected readonly UpdateCollectionPoint $updateCollectionPoint
    ) {
    }

    public function __invoke(UpdateCollectionPointRequest $request, string $uuid)
    {
        $collectionPoint = $this->updateCollectionPoint->execute(
            uuid: $uuid,
            data: $request->validated(),
            userId: Auth::id()
        );

        if (!$collectionPoint) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.',
            ], 404);
        }

        return new CollectionPointResource($collectionPoint);
    }
}
