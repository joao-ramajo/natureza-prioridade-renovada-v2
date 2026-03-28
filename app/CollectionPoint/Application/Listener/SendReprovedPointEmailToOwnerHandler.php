<?php

namespace App\CollectionPoint\Application\Listener;

use App\CollectionPoint\Infrastructure\Mail\UseCase\SendReprovedPointEmail\SendReprovedPointEmail;
use App\CollectionPoint\Application\Event\CollectionPointReproved;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReprovedPointEmailToOwnerHandler implements ShouldQueue
{
    public function __construct(
        protected readonly SendReprovedPointEmail $sendReprovedPointEmail,
    ) {
    }

    public function handle(CollectionPointReproved $event): void
    {
        $collectionPoint = $event->collectionPoint;

        $collectionPoint->load(['user']);

        $reason = $event->reason;

        $this->sendReprovedPointEmail->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint,
            reason: $reason
        );
    }
}
