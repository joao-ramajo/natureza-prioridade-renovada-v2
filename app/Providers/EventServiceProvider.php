<?php

namespace App\Providers;

use App\Auth\Application\Event\UserCreated;
use App\Auth\Application\Listener\SendVerifiedEmailHandler;
use App\CollectionPoint\Application\Event\CollectionPointApproved;
use App\CollectionPoint\Application\Event\CollectionPointContestedMessage;
use App\CollectionPoint\Application\Event\CollectionPointCreated;
use App\CollectionPoint\Application\Event\CollectionPointReproved;
use App\CollectionPoint\Application\Listener\HandleCollectionPointCreated;
use App\CollectionPoint\Application\Listener\SendApprovedPointEmailToOwnerHandler;
use App\CollectionPoint\Application\Listener\SendContestTutorialToOwnerHandler;
use App\CollectionPoint\Application\Listener\SendReprovedPointEmailToOwnerHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserCreated::class => [
            SendVerifiedEmailHandler::class,
        ],
        CollectionPointCreated::class => [
            HandleCollectionPointCreated::class,
        ],
        CollectionPointApproved::class => [
            SendApprovedPointEmailToOwnerHandler::class,
        ],
        CollectionPointReproved::class => [
            SendReprovedPointEmailToOwnerHandler::class,
        ],
        CollectionPointContestedMessage::class => [
            SendContestTutorialToOwnerHandler::class,
        ],
    ];
}
