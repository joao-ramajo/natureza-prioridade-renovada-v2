<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\AddCollectionPointImagesAction;
use App\Action\CollectionPoint\CreateCollectionPointAction;
use App\Action\CollectionPoint\UploadPrincipalImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\CreateCollectionPointRequest;
use App\Support\LogsWithContext;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCollectionPointController extends Controller
{
    use LogsWithContext;

    public function __construct(
        protected readonly CreateCollectionPointAction $createCollectionPointAction,
        protected readonly UploadPrincipalImageAction $uploadImageAction,
        protected readonly AddCollectionPointImagesAction $addImagesAction,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(CreateCollectionPointRequest $request): JsonResponse
    {
        $this->logInfo('Inicia da requisição para criaçao de um ponto de coleta');

        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $collectionPoint = $this->createCollectionPointAction->execute($data);

        $this->uploadImageAction->execute($collectionPoint, $request->file('principal_image'));

        if ($request->hasFile('images')) {
            $this->addImagesAction->execute($collectionPoint, $request->file('images'));
        }

        $payload = [
            'message' => 'Ponto de coleta criado com sucesso.',
            'collection_point_id' => $collectionPoint->uuid
        ];

        $this->logInfo('Fim da requisição para criaçao de um ponto de coleta');

        return response()->json($payload, 201);
    }
}
