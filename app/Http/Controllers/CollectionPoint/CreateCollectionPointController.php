<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Action\CollectionPoint\AddCollectionPointImagesAction;
use App\Action\CollectionPoint\CreateCollectionPointAction;
use App\Action\CollectionPoint\UploadPrincipalImageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPoint\CreateCollectionPointRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCollectionPointController extends Controller
{
    public function __construct(
        protected readonly CreateCollectionPointAction $createCollectionPointAction,
        protected readonly UploadPrincipalImageAction $uploadImageAction,
        protected readonly AddCollectionPointImagesAction $addImagesAction,
    ) {}

    public function handle(CreateCollectionPointRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $cp = $this->createCollectionPointAction->execute($data);

        $this->uploadImageAction->execute($cp, $request->file('principal_image'));

        if ($request->hasFile('images')) {
            $this->addImagesAction->execute($cp, $request->file('images'));
        }

        $payload = [
            'message' => 'Ponto de coleta criado com sucesso.',
            'cp_id' => $cp->uuid
        ];

        return response()->json($payload, 201);
    }
}
