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
        $this->logInfo('Inicio do processo de criação de um ponto de coleta', [
            'userId' => $data['user_id']
        ]);

        $data['status'] = CollectionPointStatus::PENDING;

        $cp = CollectionPoint::create($data);

        CollectionPointCreated::dispatch($cp);

        $this->logInfo('Ponto de coleta criado com sucesso', [
            'collectionPointId' => $cp->id,
            'userId' => $cp->user_id,
        ]);

        return $cp;
    }
}
