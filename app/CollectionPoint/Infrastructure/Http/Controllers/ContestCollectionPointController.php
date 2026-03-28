<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\ContestCollectionPoint\ContestCollectionPoint;
use App\CollectionPoint\Application\UseCase\FindCollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DomainException;

class ContestCollectionPointController extends Controller
{
    public function __construct(
        protected readonly FindCollectionPoint $findCollectionPoint,
        protected readonly ContestCollectionPoint $contestCollectionPoint,
    ) {
    }

    public function __invoke(string $uuid)
    {
        try {
            $collectionPoint = $this->findCollectionPoint->execute(uuid: $uuid, withImages: false);

            $this->contestCollectionPoint->execute(
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
