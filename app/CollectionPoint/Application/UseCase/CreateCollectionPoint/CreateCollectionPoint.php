<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\CreateCollectionPoint;

use App\CollectionPoint\Application\Event\CollectionPointCreated;
use App\CollectionPoint\Application\UseCase\AddCollectionPointImages\AddCollectionPointImages;
use App\CollectionPoint\Application\UseCase\UploadPrincipalImage\UploadPrincipalImage;
use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\CollectionPoint\Domain\Entity\CollectionPointStatus;
use Illuminate\Support\Str;

class CreateCollectionPoint
{
    public function __construct(
        protected readonly UploadPrincipalImage $uploadPrincipalImage,
        protected readonly AddCollectionPointImages $addCollectionPointImages
    ) {
    }

    public function execute(CreateCollectionPointInput $input): CreateCollectionPointOutput
    {
        $data = [
            'user_id' => $input->userId,
            'name' => $input->name,
            'category' => $input->category,
            'address' => $input->address,
            'city' => $input->city,
            'state' => $input->state,
            'zip_code' => $input->zipCode,
            'description' => $input->description,
            'status' => CollectionPointStatus::PENDING,
            'uuid' => Str::uuid(),
        ];

        $collectionPoint = CollectionPoint::create($data);

        $this->uploadPrincipalImage->execute($collectionPoint, $input->principalImageTemporaryPath);

        if ($input->imageTemporaryPaths !== []) {
            $this->addCollectionPointImages->execute($collectionPoint, $input->imageTemporaryPaths);
        }

        CollectionPointCreated::dispatch($collectionPoint);

        return new CreateCollectionPointOutput(
            message: 'Ponto de coleta criado com sucesso.',
            collectionPointId: (string) $collectionPoint->uuid,
        );
    }
}
