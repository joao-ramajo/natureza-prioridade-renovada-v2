<?php

namespace App\Listeners;

use App\Action\Mail\CollectionPoint\SendContestTutorialEmailAction;
use App\Events\CollectionPointContestedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendContestTutorialToOwnerHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly SendContestTutorialEmailAction $sendContestTutorialEmailAction,
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CollectionPointContestedMessage $event): void
    {
        $collectionPoint = $event->collectionPoint;

        $collectionPoint->load(['user']);

        $this->sendContestTutorialEmailAction->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint
        );
    }
}
