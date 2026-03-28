<?php

namespace App\CollectionPoint\Application\Listener;

use App\CollectionPoint\Infrastructure\Mail\UseCase\SendContestTutorialEmail\SendContestTutorialEmail;
use App\CollectionPoint\Application\Event\CollectionPointContestedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContestTutorialToOwnerHandler implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly SendContestTutorialEmail $sendContestTutorialEmail,
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

        $this->sendContestTutorialEmail->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint
        );
    }
}
