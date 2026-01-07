<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointApproved;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class ApproveCollectionPointAction
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function execute(CollectionPoint $collectionPoint): CollectionPoint
    {
        $this->logInfo('Iniciando processo de aprovação de um ponto de coleta', [
            'userId' => Auth::id(),
            'collectionPointId' => $collectionPoint->id
        ]);

        $collectionPoint->update([
            'status' => CollectionPointStatus::APPROVED,
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);

        CollectionPointApproved::dispatch($collectionPoint);

        $this->logInfo('Ponto de coleta aprovado com sucesso', [
            'userId' => Auth::id(),
            'collectionPointId' => $collectionPoint->id
        ]);

        return $collectionPoint;
    }
}
