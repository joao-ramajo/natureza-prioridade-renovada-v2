<?php

namespace App\Listeners;

use App\Action\Mail\CollectionPoint\SendReprovedPointEmailAction;
use App\Events\CollectionPointReproved;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReprovedPointEmailToOwnerHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly SendReprovedPointEmailAction $action
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CollectionPointReproved $event): void
    {
        $cp = $event->collectionPoint;
        $cp->load(['user']);
        $reason = $event->reason;
        $this->action->execute($cp->user->email, $cp->user->name, $cp, $reason);
    }
}
