<?php declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointApproved;
use App\Models\CollectionPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApproveCollectionPointAction
{
    public function execute(string $uuid): CollectionPoint
    {
        $cp = CollectionPoint::where('uuid', $uuid)->first();

        if (!$cp) {
            throw new ModelNotFoundException('Ponto de coleta não encontrado.');
        }

        $cp->update([
            'status' => CollectionPointStatus::APPROVED
        ]);

        CollectionPointApproved::dispatch($cp);

        return $cp;
    }
}
