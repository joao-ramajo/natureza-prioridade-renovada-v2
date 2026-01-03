<?php

declare(strict_types=1);

namespace App\Action\CollectionPoint;

use App\Models\CollectionPoint;
use Illuminate\Http\UploadedFile;

class UploadPrincipalImageAction
{
    public function execute(CollectionPoint $cp, UploadedFile $file): CollectionPoint
    {
        $path = $file->store('collection_points', 'public');
        $cp->update(['principal_image' => $path]);

        return $cp;
    }
}