<?php

namespace App\Action\CollectionPoint;

use App\Models\CollectionPoint;

class DeleteCollectionPointAction
{
    public function execute(string $uuid, int $userId): bool
    {
        $collectionPoint = CollectionPoint::where('uuid', $uuid)->first();

        if (!$collectionPoint) {
            return false;
        }

        if ($collectionPoint->user_id !== $userId) {
            abort(403, 'Você não tem permissão para deletar este ponto de coleta.');
        }

        $collectionPoint->delete();

        return true;
    }
}
