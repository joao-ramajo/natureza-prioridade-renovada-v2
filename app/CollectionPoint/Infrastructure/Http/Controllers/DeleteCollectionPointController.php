<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\DeleteCollectionPoint\DeleteCollectionPoint;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteCollectionPointController extends Controller
{
    public function __construct(
        protected readonly DeleteCollectionPoint $deleteCollectionPoint
    ) {
    }

    public function __invoke(string $uuid)
    {
        $deleted = $this->deleteCollectionPoint->execute(
            uuid: $uuid,
            userId: Auth::id()
        );

        if (! $deleted) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.',
            ], 404);
        }

        return response()->json([
            'message' => 'Ponto de coleta removido com sucesso.',
        ], 200);
    }
}
