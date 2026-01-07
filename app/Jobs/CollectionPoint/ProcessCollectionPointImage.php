<?php

namespace App\Jobs\CollectionPoint;

use App\Models\CollectionPoint;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessCollectionPointImage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly int $collectionPointId,
        public readonly string $tempPath
    ) {
    }

    public function handle(): void
    {
        $cp = CollectionPoint::findOrFail($this->collectionPointId);

        $finalPath = Storage::disk('public')->putFile('collection_points', Storage::path($this->tempPath));

        $cp->images()->create([
            'image_path' => $finalPath,
        ]);

        Storage::delete($this->tempPath);

        Log::info('imagem processada');
    }
}
