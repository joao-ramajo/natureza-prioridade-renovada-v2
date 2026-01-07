<?php

namespace App\Listeners;

use App\Action\Mail\CollectionPoint\SendApprovedPointEmailAction;
use App\Events\CollectionPointApproved;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendApprovedPointEmailToOwnerHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly SendApprovedPointEmailAction $action
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(CollectionPointApproved $event): void
    {
        $cp = $event->collectionPoint;
        $cp->load(['user']);
        $this->action->execute($cp->user->email, $cp->user->name, $cp);
    }
}
