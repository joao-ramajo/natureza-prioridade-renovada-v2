<?php

declare(strict_types=1);

use App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint\GeolocateCollectionPoint;
use App\CollectionPoint\Application\UseCase\GeolocateCollectionPoint\GeolocateCollectionPointInput;
use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\CollectionPoint\Domain\Entity\CollectionPointStatus;
use Illuminate\Support\Facades\Http;

test('geolocaliza um ponto de coleta e atualiza latitude e longitude', function () {
    Http::fake([
        'https://nominatim.openstreetmap.org/search*' => Http::response([
            [
                'lat' => '-23.5505200',
                'lon' => '-46.6333080',
            ],
        ]),
    ]);

    $collectionPoint = CollectionPoint::factory()->create([
        'status' => CollectionPointStatus::ACTIVE,
        'address' => 'Praça da Sé, 100',
        'city' => 'São Paulo',
        'state' => 'SP',
        'zip_code' => '01001-000',
        'lat' => null,
        'lng' => null,
    ]);

    app(GeolocateCollectionPoint::class)->execute(
        new GeolocateCollectionPointInput($collectionPoint->id)
    );

    $collectionPoint->refresh();

    expect((float) $collectionPoint->lat)->toBe(-23.55052)
        ->and((float) $collectionPoint->lng)->toBe(-46.633308);
});

test('nao atualiza latitude e longitude quando a geocodificacao nao retorna resultado', function () {
    Http::fake([
        'https://nominatim.openstreetmap.org/search*' => Http::response([]),
    ]);

    $collectionPoint = CollectionPoint::factory()->create([
        'status' => CollectionPointStatus::ACTIVE,
        'lat' => null,
        'lng' => null,
    ]);

    app(GeolocateCollectionPoint::class)->execute(
        new GeolocateCollectionPointInput($collectionPoint->id)
    );

    $collectionPoint->refresh();

    expect($collectionPoint->lat)->toBeNull()
        ->and($collectionPoint->lng)->toBeNull();
});
