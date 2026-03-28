<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\CreateCollectionPoint;

use App\CollectionPoint\Domain\ValueObject\ZipCode;
use App\CollectionPoint\Infrastructure\Http\Requests\CreateCollectionPointRequest;
use Illuminate\Support\Facades\Auth;

final readonly class CreateCollectionPointInput
{
    /**
     * @param array<int, string> $imageTemporaryPaths
     */
    public function __construct(
        public int $userId,
        public string $name,
        public string $category,
        public string $address,
        public string $city,
        public string $state,
        public string $zipCode,
        public ?string $description,
        public string $principalImageTemporaryPath,
        public array $imageTemporaryPaths,
    ) {
    }

    public static function fromRequest(CreateCollectionPointRequest $request): self
    {
        $data = $request->validated();

        $principalImageTemporaryPath = (string) $request->file('principal_image')->store('temp_uploads', 'public');
        $imageTemporaryPaths = array_map(
            static fn ($file): string => (string) $file->store('temp_uploads', 'public'),
            $request->file('images', [])
        );

        return new self(
            userId: (int) Auth::id(),
            name: (string) $data['name'],
            category: (string) $data['category'],
            address: (string) $data['address'],
            city: (string) $data['city'],
            state: (string) $data['state'],
            zipCode: ZipCode::create((string) $data['zip_code'])->getRaw(),
            description: isset($data['description']) ? (string) $data['description'] : null,
            principalImageTemporaryPath: $principalImageTemporaryPath,
            imageTemporaryPaths: $imageTemporaryPaths,
        );
    }
}
