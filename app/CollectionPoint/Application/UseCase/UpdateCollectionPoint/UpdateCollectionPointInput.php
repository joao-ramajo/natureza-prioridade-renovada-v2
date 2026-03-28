<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\UpdateCollectionPoint;

use App\CollectionPoint\Infrastructure\Http\Requests\UpdateCollectionPointRequest;
use Illuminate\Support\Facades\Auth;

final readonly class UpdateCollectionPointInput
{
    public function __construct(
        public string $uuid,
        public array $data,
        public int $userId,
    ) {
    }

    public static function fromRequest(UpdateCollectionPointRequest $request, string $uuid): self
    {
        return new self(
            uuid: $uuid,
            data: $request->validated(),
            userId: (int) Auth::id(),
        );
    }
}
