<?php

use App\Enum\CollectionPointStatus;
use App\Events\CollectionPointCreated;
use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    Event::fake();
});

test('usuario autenticado pode criar um ponto de coleta com sucesso', function () {
    $user = User::factory()->create();

    $payload = [
        'name' => 'Ponto de Coleta Centro',
        'category' => 'papel',
        'address' => 'Rua XV de Novembro, 123',
        'city' => 'Curitiba',
        'state' => 'PR',
        'zip_code' => '80020-310',
        'description' => 'Coleta de papel e plástico',
        'principal_image' => UploadedFile::fake()->image('principal.jpg'),
        'images' => [
            UploadedFile::fake()->image('extra1.jpg'),
            UploadedFile::fake()->image('extra2.jpg'),
        ],
    ];

    $response = $this
        ->actingAs($user, 'sanctum')
        ->postJson(route('collection_points.create'), $payload);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'message',
            'collection_point_id',
        ]);

    $this->assertDatabaseHas('collection_points', [
        'name' => 'Ponto de Coleta Centro',
        'user_id' => $user->id,
    ]);

    $collectionPoint = CollectionPoint::where('uuid', $response->json('collection_point_id'))->first();
    expect($collectionPoint)->not()->toBeNull();
    expect($collectionPoint->name)->toBe($payload['name']);
    expect($collectionPoint->user_id)->toBe($user->id);
    expect($collectionPoint->status)->toBe(CollectionPointStatus::PENDING);

    Storage::disk('public')->assertExists($collectionPoint->principal_image);
    foreach ($collectionPoint->images as $image) {
        Storage::disk('public')->assertExists($image->getImagePath());
    }

    Event::assertDispatched(CollectionPointCreated::class, function ($event) use ($collectionPoint) {
        return $event->collectionPoint->id === $collectionPoint->id;
    });
});


test('aceita cep sem hífen e normaliza corretamente', function () {
    $user = User::factory()->create();

    $payload = [
        'name' => 'Ponto de Coleta Sem Hífen',
        'category' => 'vidro',
        'address' => 'Rua ABC, 100',
        'city' => 'São Paulo',
        'state' => 'SP',
        'zip_code' => '01234567',
        'description' => 'Coleta de vidro',
        'principal_image' => UploadedFile::fake()->image('principal.jpg'),
    ];

    $response = $this
        ->actingAs($user, 'sanctum')
        ->postJson(route('collection_points.create'), $payload);

    $response->assertCreated();
    $collectionPoint = CollectionPoint::where('uuid', $response->json('collection_point_id'))->first();

    expect($collectionPoint->zip_code)->toBe('01234567');
});