<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\CreateCollectionPoint\CreateCollectionPoint;
use App\Http\Controllers\Controller;
use App\CollectionPoint\Infrastructure\Http\Requests\CreateCollectionPointRequest;
use Domain\Input\CreateCollectionPointInput;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCollectionPointController extends Controller
{
    public function __construct(
        protected readonly CreateCollectionPoint $createCollectionPoint,
    ) {
    }

    public function __invoke(CreateCollectionPointRequest $request): JsonResponse
    {
        $data = CreateCollectionPointInput::fromRequest($request);

        $collectionPoint = $this->createCollectionPoint->execute($data);

        $payload = [
            'message' => 'Ponto de coleta criado com sucesso.',
            'collection_point_id' => $collectionPoint->uuid
        ];

        return response()->json($payload, 201);
    }
}
