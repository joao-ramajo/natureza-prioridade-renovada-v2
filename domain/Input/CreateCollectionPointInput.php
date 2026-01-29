<?php declare(strict_types=1);

namespace Domain\Input;

use App\Http\Requests\CollectionPoint\CreateCollectionPointRequest;
use Domain\ZipCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class CreateCollectionPointInput
{
    private function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $category,
        public readonly string $address,
        public readonly string $city,
        public readonly string $state,
        public readonly ZipCode $zip_code,
        public readonly ?string $description,
        public readonly UploadedFile $principal_image,
        public readonly ?array $images
    ) {}

    public static function fromRequest(CreateCollectionPointRequest $request): self
    {
        $data = $request->validated();
        $images = $request->has('images') ? array_map(fn($f) => $f instanceof UploadedFile ? $f : null, $request->file('images')) : null;
        return new self(
            Auth::id(),
            $data['name'],
            $data['category'],
            $data['address'],
            $data['city'],
            $data['state'],
            ZipCode::create($data['zip_code']),
            $data['description'] ?? null,
            $request->file('principal_image'),
            $images
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'name' => $this->name,
            'category' => $this->category,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code->getRaw(),
            'description' => $this->description,
            'principal_image' => $this->principal_image,
            'images' => $this->images ?? [],
        ];
    }
}
