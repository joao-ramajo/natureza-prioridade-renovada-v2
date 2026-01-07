<?php

namespace App\Listeners;

use App\Action\Mail\CollectionPoint\SendApprovedPointEmailAction;
use App\Events\CollectionPointApproved;
use App\Support\LogsWithContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;

class SendApprovedPointEmailToOwnerHandler implements ShouldQueue
{
    use LogsWithContext;

    /**
     * Create the event listener.
     */
    public function __construct(
        protected readonly SendApprovedPointEmailAction $sendApprovedPointEmailAction,
        protected readonly LoggerInterface $logger,
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(CollectionPointApproved $event): void
    {
        $collectionPoint = $event->collectionPoint;

        $collectionPoint->load(['user']);

        $this->logInfo('Evento recebido para enviar email para o criador do ponto', [
            'collectionPointId' => $collectionPoint->id,
            'ownerEmail' => $collectionPoint->user->email,
        ]);

        $this->sendApprovedPointEmailAction->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint
        );
    }
}
