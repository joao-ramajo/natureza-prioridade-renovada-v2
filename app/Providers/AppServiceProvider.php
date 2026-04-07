<?php

namespace App\Providers;

use App\CollectionPoint\Application\Contract\CollectionPointGeocoder;
use App\CollectionPoint\Infrastructure\Geocoding\NominatimCollectionPointGeocoder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CollectionPointGeocoder::class, NominatimCollectionPointGeocoder::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
