<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\DeleteCollectionPoint\DeleteCollectionPoint;
use App\CollectionPoint\Application\UseCase\DeleteCollectionPoint\DeleteCollectionPointInput;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteDeleteCollectionPoint extends Controller
{
    public function __construct(
        protected readonly DeleteCollectionPoint $deleteCollectionPoint
    ) {
    }

    public function __invoke(string $uuid)
    {
        $output = $this->deleteCollectionPoint->execute(new DeleteCollectionPointInput(
            uuid: $uuid,
            userId: (int) Auth::id(),
        ));

        if (! $output) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.',
            ], 404);
        }

        return response()->json($output->toArray(), 200);
    }
}
