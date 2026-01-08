<?php

declare(strict_types=1);

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\ApproveCollectionPointAction;
use App\Action\CollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionPointResource;
use App\Support\LogsWithContext;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class ApproveCollectionPointController extends Controller
{
    use LogsWithContext;

    public function __construct(
        protected readonly ApproveCollectionPointAction $approveCollectionPoint,
        protected readonly FindCollectionPoint $findCollectionPoint,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(string $uuid)
    {
        $this->info('Iniciando requisição para aprovar ponto de coleta', [
            'userId' => Auth::id(),
            'collectionPointUuid' => $uuid,
        ]);

        $collectionPoint = $this->findCollectionPoint->execute(
            uuid: $uuid,
            withImages: false
        );

        if (!$collectionPoint) {
            $this->warning('Ponto de coleta não encontrado', [
                'userId' => Auth::id(),
                'collectionPointUuid' => $uuid,
            ]);

            return response()->json([
                'message' => 'Ponto não encontrado'
            ], 404);
        }

        $this->approveCollectionPoint->execute(collectionPoint: $collectionPoint);

        $this->info('Fim da requisição');

        return response()->json([
            'message' => 'Ponto de coleta aprovado.',
            'data' => new CollectionPointResource($collectionPoint)
        ], 200);
    }
}
