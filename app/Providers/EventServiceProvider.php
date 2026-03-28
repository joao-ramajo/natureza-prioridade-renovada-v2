<?php

namespace App\Providers;

use App\Auth\Application\Event\UserCreated;
use App\Auth\Application\Listener\SendVerifiedEmailHandler;
use App\CollectionPoint\Application\Event\CollectionPointCreated;
use App\CollectionPoint\Application\Listener\HandleCollectionPointCreated;
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
    ];
}
