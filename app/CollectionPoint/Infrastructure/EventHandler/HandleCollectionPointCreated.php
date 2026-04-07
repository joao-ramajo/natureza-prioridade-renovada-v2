<?php

namespace App\CollectionPoint\Infrastructure\EventHandler;

use App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint\GeolocateCollectionPoint;
use App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint\GeolocateCollectionPointInput;
use App\CollectionPoint\Domain\Event\CollectionPointCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Attributes\Backoff;
use Illuminate\Queue\Attributes\DeleteWhenMissingModels;
use Illuminate\Queue\Attributes\Queue;
use Psr\Log\LoggerInterface;

#[Queue('default')]
#[Backoff(60, 300, 900)]
#[DeleteWhenMissingModels]
class HandleCollectionPointCreated implements ShouldQueue
{
    public function __construct(
        protected readonly GeolocateCollectionPoint $geolocateCollectionPoint,
        protected readonly LoggerInterface $logger
    ) {}

    public function handle(CollectionPointCreated $event): void
    {
        $this->geolocateCollectionPoint->execute(
            new GeolocateCollectionPointInput($event->collectionPointId)
        );
        $this->logger->info('Evento disparado');
    }
}
