<?php

declare(strict_types=1);

namespace App\CollectionPoint\Infrastructure\Geocoding;

use App\CollectionPoint\Application\Contract\CollectionPointGeocoder;
use App\CollectionPoint\Application\DataTransferObject\GeocodedLocation;
use Illuminate\Support\Facades\Http;
use Psr\Log\LoggerInterface;
use Throwable;

final class NominatimCollectionPointGeocoder implements CollectionPointGeocoder
{
    public function __construct(
        private LoggerInterface $logger
    )
    {}

    public function geocode(string $address): ?GeocodedLocation
    {
        try {
            $response = Http::baseUrl((string) config('services.geocoding.base_url'))
                ->acceptJson()
                ->timeout(10)
                ->withHeaders([
                    'User-Agent' => (string) config('services.geocoding.user_agent'),
                ])
                ->get('/search', [
                    'q' => $address,
                    'format' => 'jsonv2',
                    'limit' => 1,
                    'countrycodes' => config('services.geocoding.country_code'),
                ])
                ->throw();

                $this->logger->info('Geocodificacao realizada com sucesso.', [
                    'address' => $address,
                    'response' => $response->body(),
                ]);
        } catch (Throwable $e) {
            $this->logger->error('Erro ao geocodificar endereço.', [
                'address' => $address,
                'exception' => $e,
            ]);
            return null;
        }

        $result = $response->json('0');

        if (! is_array($result) || ! isset($result['lat'], $result['lon'])) {
            return null;
        }

        return new GeocodedLocation(
            latitude: (float) $result['lat'],
            longitude: (float) $result['lon'],
        );
    }
}
