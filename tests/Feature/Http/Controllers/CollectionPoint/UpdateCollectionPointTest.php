<?php

use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

test('user can update own collection point', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $collectionPoint = CollectionPoint::factory()
        ->for($user)
        ->create([
            'name' => 'Ponto Antigo',
            'city' => 'São Paulo',
        ]);

    $payload = [
        'name' => 'Ponto Atualizado',
        'city' => 'Campinas',
    ];

    $response = $this->putJson(
        route('collection_points.update', $collectionPoint->uuid),
        $payload
    );

    $response
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $collectionPoint->uuid,
                'name' => 'Ponto Atualizado',
                'city' => 'Campinas',
            ],
        ]);

    $this->assertDatabaseHas('collection_points', [
        'uuid' => $collectionPoint->uuid,
        'name' => 'Ponto Atualizado',
        'city' => 'Campinas',
    ]);
});

test('it returns 404 when collection point does not exist', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->putJson(
        route('collection_points.update', Str::uuid()),
        ['name' => 'Novo Nome']
    );

    $response
        ->assertNotFound()
        ->assertJson([
            'message' => 'Ponto de coleta não encontrado.',
        ]);
});

test('it requires authentication to update collection point', function () {
    $collectionPoint = CollectionPoint::factory()->create();

    $response = $this->putJson(
        route('collection_points.update', $collectionPoint->uuid),
        ['name' => 'Tentativa']
    );

    $response->assertUnauthorized();
});

test('user cannot update collection point from another user', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();

    $collectionPoint = CollectionPoint::factory()
        ->for($owner)
        ->create();

    Sanctum::actingAs($otherUser);

    $response = $this->putJson(
        route('collection_points.update', $collectionPoint->uuid),
        ['name' => 'Nome Indevido']
    );

    $response->assertForbidden();

    $this->assertDatabaseHas('collection_points', [
        'uuid' => $collectionPoint->uuid,
    ]);
});