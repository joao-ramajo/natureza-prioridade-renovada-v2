<?php

namespace App\Action\CollectionPoint;

use App\Models\CollectionPoint;

class UpdateCollectionPointAction
{
    public function execute(string $uuid, array $data, int $userId): ?CollectionPoint
    {
        $collectionPoint = CollectionPoint::where('uuid', $uuid)->first();

        if (! $collectionPoint) {
            return null;
        }

        if ($collectionPoint->user_id !== $userId) {
            abort(403, 'Você não tem permissão para atualizar este ponto de coleta.');
        }

        unset(
            $data['id'],
            $data['uuid'],
            $data['user_id'],
            $data['status'],
            $data['approved_at'],
            $data['rejected_at']
        );

        $collectionPoint->update($data);

        return $collectionPoint->refresh();
    }
}
