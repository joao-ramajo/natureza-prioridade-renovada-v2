<?php

namespace App\Listeners;

use App\Events\CollectionPointCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandleCollectionPointCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CollectionPointCreated $event): void
    {
        $cp = $event->collectionPoint;
    }
}
