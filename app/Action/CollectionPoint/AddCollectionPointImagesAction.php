<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Jobs\CollectionPoint\ProcessCollectionPointImageJob;
use App\Models\CollectionPoint;

class AddCollectionPointImagesAction
{
    public function execute(CollectionPoint $cp, array $files): void
    {
        foreach ($files as $file) {
            $tempPath = $file->store('temp_uploads');
            ProcessCollectionPointImageJob::dispatch($cp->id, $tempPath);
        }
    }
}
