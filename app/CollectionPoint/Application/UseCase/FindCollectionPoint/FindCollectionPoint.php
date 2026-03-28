<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\FindCollectionPoint;

use App\CollectionPoint\Domain\CollectionPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindCollectionPoint
{
    /**
     * @param string $uuid
     * @param bool $withImages
     */
    public function execute(string $uuid, bool $withImages = true): ?CollectionPoint
    {
        $cp = CollectionPoint::where('uuid', $uuid)->with('user:id,name,email')->first();

        if (!$cp) {
            throw new ModelNotFoundException('Ponto de coleta não encontrado.');
        }

        if ($withImages) {
            $cp->load(['images']);
        }

        return $cp;
    }
}
