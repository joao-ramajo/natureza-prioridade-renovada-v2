<?php

use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

test('it can fetch a collection point by uuid', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $collectionPoint = CollectionPoint::factory()
        ->for($user)
        ->create();

    $response = $this->getJson(
        route('collection_points.find', $collectionPoint->uuid)
    );

    $response
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'status',
                'category',
                'city',
                'state',
                'created_by' => [
                    'name',
                    'email',
                ],
                'created_at',
            ],
        ])
        ->assertJson([
            'data' => [
                'id' => $collectionPoint->uuid,
            ],
        ]);
});

test('it returns 404 when collection point does not exist', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson(
        route('collection_points.find', Str::uuid())
    );

    $response
        ->assertNotFound()
        ->assertJson([
            'message' => 'Ponto de coleta não encontrado.',
        ]);
});