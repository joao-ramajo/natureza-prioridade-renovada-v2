<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Http\Controllers\Controller;
use App\Action\CollectionPoint\DeleteCollectionPointAction;
use Illuminate\Support\Facades\Auth;

class DeleteCollectionPointController extends Controller
{
    public function __construct(
        protected readonly DeleteCollectionPointAction $deleteCollectionPointAction
    ) {
    }

    public function __invoke(string $uuid)
    {
        $deleted = $this->deleteCollectionPointAction->execute(
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
