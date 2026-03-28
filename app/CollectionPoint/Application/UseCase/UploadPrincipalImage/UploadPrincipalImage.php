<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\UploadPrincipalImage;

use App\CollectionPoint\Domain\CollectionPoint;
use Illuminate\Http\UploadedFile;

class UploadPrincipalImage
{
    public function execute(CollectionPoint $cp, UploadedFile $file): CollectionPoint
    {
        $path = $file->store('collection_points', 'public');
        $cp->update(['principal_image' => $path]);

        return $cp;
    }
}
