<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\ContestCollectionPointAction;
use App\Action\CollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use App\Support\LogsWithContext;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;
use DomainException;
use Exception;

class ContestCollectionPointController extends Controller
{
    use LogsWithContext;

    public function __construct(
        protected readonly FindCollectionPoint $findCollectionPointAction,
        protected readonly ContestCollectionPointAction $contestCollectionPointAction,
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(string $uuid)
    {
        $this->info('Iniciando contestação de ponto de coleta', [
            'collectionPointUuid' => $uuid,
            'userId' => Auth::id(),
        ]);

        try {
            $collectionPoint = $this->findCollectionPointAction->execute(uuid: $uuid, withImages: false);

            $this->contestCollectionPointAction->execute(
                collectionPoint: $collectionPoint,
                userId: Auth::id()
            );

            return response()
                ->json([
                    'message' => 'Ponto de coleta contestado com sucesso, aguarde o email para mais informações.'
                ], 200);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
