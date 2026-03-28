<?php

namespace App\Providers;

use App\Auth\Domain\Event\UserCreated;
use App\Auth\Infrastructure\EventHandler\SendVerifiedEmailHandler;
use App\CollectionPoint\Domain\Event\CollectionPointCreated;
use App\CollectionPoint\Infrastructure\EventHandler\HandleCollectionPointCreated;
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
