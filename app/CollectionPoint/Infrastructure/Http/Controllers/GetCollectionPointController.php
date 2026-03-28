<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\LoadCollectionPointByUuid\LoadCollectionPointByUuid;
use App\CollectionPoint\Application\UseCase\LoadCollectionPointByUuid\LoadCollectionPointByUuidInput;
use App\Http\Controllers\Controller;

class GetCollectionPointController extends Controller
{
    public function __construct(
        protected readonly LoadCollectionPointByUuid $loadCollectionPointByUuid
    ) {
    }

    public function __invoke(string $uuid)
    {
        $output = $this->loadCollectionPointByUuid->execute(new LoadCollectionPointByUuidInput($uuid));

        if (!$output) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.'
            ], 404);
        }

        return response()->json($output->toArray());
    }
}
