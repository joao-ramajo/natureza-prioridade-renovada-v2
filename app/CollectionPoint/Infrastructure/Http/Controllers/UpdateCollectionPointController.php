<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\UpdateCollectionPoint\UpdateCollectionPoint;
use App\CollectionPoint\Application\UseCase\UpdateCollectionPoint\UpdateCollectionPointInput;
use App\CollectionPoint\Infrastructure\Http\Requests\UpdateCollectionPointRequest;
use App\Http\Controllers\Controller;

class UpdateCollectionPointController extends Controller
{
    public function __construct(
        protected readonly UpdateCollectionPoint $updateCollectionPoint
    ) {
    }

    public function __invoke(UpdateCollectionPointRequest $request, string $uuid)
    {
        $output = $this->updateCollectionPoint->execute(
            UpdateCollectionPointInput::fromRequest($request, $uuid)
        );

        if (!$output) {
            return response()->json([
                'message' => 'Ponto de coleta não encontrado.',
            ], 404);
        }

        return response()->json($output->toArray());
    }
}
