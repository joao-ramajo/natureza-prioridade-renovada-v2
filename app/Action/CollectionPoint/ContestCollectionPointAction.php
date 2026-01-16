<?php

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointContestedMessage;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;
use DomainException;

class ContestCollectionPointAction
{
    use LogsWithContext;

    private const CONTESTATION_DAYS_LIMIT = 7;

    public function __construct(
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function execute(CollectionPoint $collectionPoint, int $userId): void
    {
        $this->ensureCanBeContested($collectionPoint, $userId);

        DB::transaction(function () use ($collectionPoint) {
            $collectionPoint->update([
                'status' => CollectionPointStatus::CONTESTATION,
                'contested_at' => Carbon::now(),
                'contestation_deadline' => Carbon::now()->addDays(self::CONTESTATION_DAYS_LIMIT)
            ]);

            CollectionPointContestedMessage::dispatch($collectionPoint);
        });

        $this->info('Ponto de coleta contestado com sucesso', [
            'collectionPointId' => $collectionPoint->id,
            'collectionPointStatus' => $collectionPoint->status->value
        ]);
    }

    private function ensureCanBeContested(CollectionPoint $collectionPoint, int $userId): void
    {
        if ($collectionPoint->status === CollectionPointStatus::REJECTED) {
            return;
        }

        $this->warning('Tentativa de contestar ponto de coleta fora do status rejeitado', [
            'collectionPointId' => $collectionPoint->id,
            'collectionPointStatus' => $collectionPoint->status->value,
            'userId' => $userId,
        ]);

        throw new DomainException('Apenas pontos de coleta com status "rejeitado" podem ser contestados.');
    }
}
