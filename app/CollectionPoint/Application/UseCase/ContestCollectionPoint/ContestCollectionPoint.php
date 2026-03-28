<?php

namespace App\CollectionPoint\Application\UseCase\ContestCollectionPoint;

use App\CollectionPoint\Domain\CollectionPointStatus;
use App\CollectionPoint\Application\Event\CollectionPointContestedMessage;
use App\CollectionPoint\Domain\CollectionPoint;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DomainException;

class ContestCollectionPoint
{
    private const CONTESTATION_DAYS_LIMIT = 7;

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
    }

    private function ensureCanBeContested(CollectionPoint $collectionPoint, int $userId): void
    {
        if ($collectionPoint->status === CollectionPointStatus::REJECTED) {
            return;
        }

        throw new DomainException('Apenas pontos de coleta com status "rejeitado" podem ser contestados.');
    }
}
