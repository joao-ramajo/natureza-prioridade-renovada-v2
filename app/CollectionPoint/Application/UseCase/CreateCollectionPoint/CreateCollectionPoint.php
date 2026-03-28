<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\CreateCollectionPoint;

use App\CollectionPoint\Application\Event\CollectionPointCreated;
use App\CollectionPoint\Application\UseCase\AddCollectionPointImages\AddCollectionPointImages;
use App\CollectionPoint\Application\UseCase\UploadPrincipalImage\UploadPrincipalImage;
use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\CollectionPoint\Domain\Entity\CollectionPointStatus;
use Domain\Input\CreateCollectionPointInput;
use Illuminate\Support\Str;

class CreateCollectionPoint
{
    public function __construct(
        protected readonly UploadPrincipalImage $uploadPrincipalImage,
        protected readonly AddCollectionPointImages $addCollectionPointImages
    ) {
    }

    public function execute(CreateCollectionPointInput $input): CollectionPoint
    {
        $data = $input->toArray();

        $data['status'] = CollectionPointStatus::PENDING;
        $data['uuid'] = Str::uuid();

        $collectionPoint = CollectionPoint::create($data);

        $this->uploadPrincipalImage->execute($collectionPoint, $input->principal_image);

        if ($input->images) {
            $this->addCollectionPointImages->execute($collectionPoint, $input->images);
        }

        CollectionPointCreated::dispatch($collectionPoint);

        return $collectionPoint;
    }
}
