<?php

namespace App\CollectionPoint\Application\Listener;

use App\CollectionPoint\Infrastructure\Mail\UseCase\SendApprovedPointEmail\SendApprovedPointEmail;
use App\CollectionPoint\Application\Event\CollectionPointApproved;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendApprovedPointEmailToOwnerHandler implements ShouldQueue
{
    public function __construct(
        protected readonly SendApprovedPointEmail $sendApprovedPointEmail,
    ) {
    }

    public function handle(CollectionPointApproved $event): void
    {
        $collectionPoint = $event->collectionPoint;

        $collectionPoint->load(['user']);

        $this->sendApprovedPointEmail->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint
        );
    }
}
