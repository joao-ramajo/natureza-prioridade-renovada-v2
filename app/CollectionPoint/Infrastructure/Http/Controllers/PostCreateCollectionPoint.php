<?php

namespace App\CollectionPoint\Infrastructure\Http\Controllers;

use App\CollectionPoint\Application\UseCase\CreateCollectionPoint\CreateCollectionPoint;
use App\CollectionPoint\Application\UseCase\CreateCollectionPoint\CreateCollectionPointInput;
use App\CollectionPoint\Infrastructure\Http\Requests\CreateCollectionPointRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostCreateCollectionPoint extends Controller
{
    public function __construct(
        protected readonly CreateCollectionPoint $createCollectionPoint,
    ) {
    }

    public function __invoke(CreateCollectionPointRequest $request): JsonResponse
    {
        $output = $this->createCollectionPoint->execute(CreateCollectionPointInput::fromRequest($request));

        return response()->json($output->toArray(), 201);
    }
}
