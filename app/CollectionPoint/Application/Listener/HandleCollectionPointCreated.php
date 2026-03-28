<?php

namespace App\CollectionPoint\Application\Listener;

use App\CollectionPoint\Application\Event\CollectionPointCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

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
