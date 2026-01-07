<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\UpdateCollectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\UpdateCollectionPointRequest;
use App\Http\Resources\CollectionPointResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCollectionPointController extends Controller
{
    public function __construct(
        protected readonly UpdateCollectionPointAction $updateCollectionPointAction
    ) {
    }

    public function __invoke(UpdateCollectionPointRequest $request, string $uuid)
    {
        $collectionPoint = $this->updateCollectionPointAction->execute(
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
