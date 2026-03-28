<?php

namespace App\CollectionPoint\Application\UseCase\UpdateCollectionPoint;

use App\CollectionPoint\Domain\Entity\CollectionPoint;

class UpdateCollectionPoint
{
    public function execute(UpdateCollectionPointInput $input): ?UpdateCollectionPointOutput
    {
        $collectionPoint = CollectionPoint::where('uuid', $input->uuid)
            ->with('user:id,name,email')
            ->first();

        if (! $collectionPoint) {
            return null;
        }

        if ($collectionPoint->user_id !== $input->userId) {
            abort(403, 'Você não tem permissão para atualizar este ponto de coleta.');
        }

        $data = $input->data;

        unset(
            $data['id'],
            $data['uuid'],
            $data['user_id'],
            $data['status']
        );

        $collectionPoint->update($data);

        return UpdateCollectionPointOutput::fromEntity(
            $collectionPoint->refresh()->loadMissing('user:id,name,email')
        );
    }
}
