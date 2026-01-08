<?php

namespace App\Listeners;

use App\Action\Mail\CollectionPoint\SendReprovedPointEmailAction;
use App\Events\CollectionPointReproved;
use App\Support\LogsWithContext;
use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;

class SendReprovedPointEmailToOwnerHandler implements ShouldQueue
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger,
        protected readonly SendReprovedPointEmailAction $sendReprovedPointEmailAction,
    ) {
    }

    public function handle(CollectionPointReproved $event): void
    {
        $collectionPoint = $event->collectionPoint;

        $collectionPoint->load(['user']);

        $this->info('Evento recebido para enviar email para o criador do ponto', [
            'collectionPointId' => $collectionPoint->id,
            'ownerEmail' => $collectionPoint->user->email,
        ]);

        $reason = $event->reason;

        $this->sendReprovedPointEmailAction->execute(
            email: $collectionPoint->user->email,
            name: $collectionPoint->user->name,
            collectionPoint: $collectionPoint,
            reason: $reason
        );
    }
}
