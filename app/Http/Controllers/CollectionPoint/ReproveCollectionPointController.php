<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\ReproveCollectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\ReproveCollectionPointRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ReproveCollectionPointController extends Controller
{
    public function __construct(
        protected readonly ReproveCollectionPointAction $action
    ) {}

    public function handle(ReproveCollectionPointRequest $request, string $uuid): JsonResponse
    {
        try {
            $this->action->execute($uuid, $request->input('reason'));

            return response()->json([
                'message' => 'Ponto de coleta reprovado com sucesso.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
