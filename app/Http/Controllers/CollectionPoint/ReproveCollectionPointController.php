<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\FindCollectionPoint;
use App\Action\CollectionPoint\ReproveCollectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\ReproveCollectionPointRequest;
use App\Support\LogsWithContext;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class ReproveCollectionPointController extends Controller
{
    use LogsWithContext;

    public function __construct(
        protected readonly ReproveCollectionPointAction $reproveCollectionPointAction,
        protected readonly FindCollectionPoint $findCollectionPointAction,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(ReproveCollectionPointRequest $request, string $uuid): JsonResponse
    {
        $this->info('Iniciando requisição para reprovação de um ponto de coleta', [
            'userId' => Auth::id(),
            'collectionPointUuid' => $uuid
        ]);

        $collectionPoint = $this->findCollectionPointAction->execute(
            uuid: $uuid,
            withImages: false
        );

        $this->reproveCollectionPointAction->execute(
            collectionPoint: $collectionPoint,
            reason: $request->input('reason')
        );

        $this->info('Fim da requisição de reprovação de ponto', [
            'userId' => Auth::id(),
            'collectionPointUuid' => $uuid
        ]);

        return response()->json([
            'message' => 'Ponto de coleta reprovado com sucesso.'
        ], 200);
    }
}
