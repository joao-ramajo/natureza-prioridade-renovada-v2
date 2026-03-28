<?php

declare(strict_types=1);

namespace App\CollectionPoint\Application\UseCase\UploadPrincipalImage;

use App\CollectionPoint\Domain\Entity\CollectionPoint;
use Illuminate\Support\Facades\Storage;

class UploadPrincipalImage
{
    public function execute(CollectionPoint $cp, string $temporaryPath): CollectionPoint
    {
        $path = Storage::disk('public')->putFile('collection_points', Storage::disk('public')->path($temporaryPath));
        $cp->update(['principal_image' => $path]);
        Storage::disk('public')->delete($temporaryPath);

        return $cp;
    }
}
