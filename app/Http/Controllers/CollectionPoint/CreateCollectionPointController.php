<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\AddCollectionPointImagesAction;
use App\Action\CollectionPoint\CreateCollectionPointAction;
use App\Action\CollectionPoint\UploadPrincipalImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\CreateCollectionPointRequest;
use App\Support\LogsWithContext;
use Domain\Input\CreateCollectionPointInput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCollectionPointController extends Controller
{
    use LogsWithContext;

    public function __construct(
        protected readonly CreateCollectionPointAction $createCollectionPointAction,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(CreateCollectionPointRequest $request): JsonResponse
    {
        $this->info('Inicia da requisição para criaçao de um ponto de coleta');

        $data = CreateCollectionPointInput::fromRequest($request);

        $collectionPoint = $this->createCollectionPointAction->execute($data);

        $payload = [
            'message' => 'Ponto de coleta criado com sucesso.',
            'collection_point_id' => $collectionPoint->uuid
        ];

        $this->info('Fim da requisição para criaçao de um ponto de coleta');

        return response()->json($payload, 201);
    }
}
