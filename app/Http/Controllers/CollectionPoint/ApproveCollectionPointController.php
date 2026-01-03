<?php declare(strict_types=1);

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\ApproveCollectionPointAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionPointResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApproveCollectionPointController extends Controller
{
    public function __construct(
        protected readonly ApproveCollectionPointAction $approveCollectionPoint
    ) {}

    public function handle(string $uuid)
    {
        try {
            $cp = $this->approveCollectionPoint->execute($uuid);

            return response()->json([
                'message' => 'Ponto de coleta aprovado.',
                'data' => new CollectionPointResource($cp)
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
