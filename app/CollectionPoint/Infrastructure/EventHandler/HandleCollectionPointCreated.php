<?php

namespace App\CollectionPoint\Infrastructure\EventHandler;

use App\CollectionPoint\Domain\Event\CollectionPointCreated;
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
