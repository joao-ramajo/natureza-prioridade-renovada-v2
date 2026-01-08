<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointCreated;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Psr\Log\LoggerInterface;

class CreateCollectionPointAction
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger
    ) {
    }

    public function execute(array $data): CollectionPoint
    {
        $this->info('Inicio do processo de criação de um ponto de coleta', [
            'userId' => $data['user_id']
        ]);

        $data['status'] = CollectionPointStatus::PENDING;

        $collectionPoint = CollectionPoint::create($data);

        CollectionPointCreated::dispatch($collectionPoint);

        $this->info('Ponto de coleta criado com sucesso', [
            'collectionPointId' => $collectionPoint->id,
            'userId' => $collectionPoint->user_id,
        ]);

        return $collectionPoint;
    }
}
