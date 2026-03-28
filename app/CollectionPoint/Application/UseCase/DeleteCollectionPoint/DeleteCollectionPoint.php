<?php

namespace App\CollectionPoint\Application\UseCase\DeleteCollectionPoint;

use App\CollectionPoint\Domain\Entity\CollectionPoint;

class DeleteCollectionPoint
{
    public function execute(DeleteCollectionPointInput $input): ?DeleteCollectionPointOutput
    {
        $collectionPoint = CollectionPoint::where('uuid', $input->uuid)->first();

        if (!$collectionPoint) {
            return null;
        }

        if ($collectionPoint->user_id !== $input->userId) {
            abort(403, 'Você não tem permissão para deletar este ponto de coleta.');
        }

        $collectionPoint->delete();

        return new DeleteCollectionPointOutput('Ponto de coleta removido com sucesso.');
    }
}
