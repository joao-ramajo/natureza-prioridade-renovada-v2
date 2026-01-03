<?php declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointReproved;
use App\Models\CollectionPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReproveCollectionPointAction
{
    public function execute(string $uuid, string $reason): void
    {
        $cp = CollectionPoint::where('uuid', $uuid)->first();

        if (!$cp) {
            throw new ModelNotFoundException('Ponto de coleta não encontrado.');
        }

        $cp->update([
            'rejected_at' => now(),
            'rejection_reason' => $reason,
            'status' => CollectionPointStatus::REJECTED,
        ]);

        CollectionPointReproved::dispatch($cp, $reason);
    }
}
