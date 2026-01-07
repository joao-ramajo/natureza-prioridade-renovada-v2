<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\FindCollectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionPointResource;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class GetCollectionPointController extends Controller
{
    public function __construct(
        protected readonly FindCollectionPoint $findCollectionPointAction
    ) {
    }

    public function __invoke(string $uuid)
    {
        $cp = $this->findCollectionPointAction->execute($uuid);

        if (!$cp) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.'
            ], 404);
        }

        return new CollectionPointResource($cp);
    }
}
