<?php

namespace App\CollectionPoint\Application\UseCase\DeleteCollectionPoint;

use App\CollectionPoint\Domain\Entity\CollectionPoint;

class DeleteCollectionPoint
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
