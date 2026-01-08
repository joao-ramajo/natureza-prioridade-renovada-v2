<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointReproved;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Log\LoggerInterface;

class ReproveCollectionPointAction
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function execute(CollectionPoint $collectionPoint, string $reason): void
    {
        $this->info('Iniciando processo para reprovação de um ponto de coleta', [
            'collectionPointId' => $collectionPoint->id,
        ]);

        $collectionPoint->update([
            'rejected_at' => now(),
            'rejection_reason' => $reason,
            'status' => CollectionPointStatus::REJECTED,
        ]);

        CollectionPointReproved::dispatch($collectionPoint, $reason);

        $this->info('Ponto de coleta reprovado');
    }
}
