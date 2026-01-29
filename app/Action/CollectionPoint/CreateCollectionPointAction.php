<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointCreated;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Domain\Input\CreateCollectionPointInput;
use Domain\ZipCode;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCollectionPointAction
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger,
        protected readonly UploadPrincipalImageAction $uploadPrincipalImageAction,
        protected readonly AddCollectionPointImagesAction $addCollectionPointImagesAction
    ) {
    }

    public function execute(CreateCollectionPointInput $input): CollectionPoint
    {
        $this->info('Inicio do processo de criação de um ponto de coleta', [
            'userId' => $input->userId
        ]);

        $data = $input->toArray();

        $data['status'] = CollectionPointStatus::PENDING;
        $data['uuid'] = Str::uuid();

        $collectionPoint = CollectionPoint::create($data);

        $this->uploadPrincipalImageAction->execute($collectionPoint, $input->principal_image);

        if ($input->images) {
            $this->addCollectionPointImagesAction->execute($collectionPoint, $input->images);
        }

        CollectionPointCreated::dispatch($collectionPoint);

        $this->info('Ponto de coleta criado com sucesso', [
            'collectionPointId' => $collectionPoint->id,
            'userId' => $collectionPoint->user_id,
        ]);

        return $collectionPoint;
    }
}
