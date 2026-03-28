<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\AddCollectionPointImages;

use App\CollectionPoint\Infrastructure\Jobs\ProcessCollectionPointImageJob;
use App\CollectionPoint\Domain\Entity\CollectionPoint;

class AddCollectionPointImages
{
    public function execute(CollectionPoint $cp, array $files): void
    {
        foreach ($files as $file) {
            $tempPath = $file->store('temp_uploads');
            ProcessCollectionPointImageJob::dispatch($cp->id, $tempPath);
        }
    }
}
