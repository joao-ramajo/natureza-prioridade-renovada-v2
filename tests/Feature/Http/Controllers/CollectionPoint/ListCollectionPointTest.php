<?php

use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list collection points with pagination', function () {
    CollectionPoint::factory()->count(20)->create();

    $response = $this->getJson(
        route('collection_points.list')
    );

    $response
        ->assertOk()
        ->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);

    expect($response->json('data'))->toHaveCount(15);
});

test('can filter collection points by city', function () {
    CollectionPoint::factory()->create([
        'city' => 'São Paulo',
    ]);

    CollectionPoint::factory()->create([
        'city' => 'Rio de Janeiro',
    ]);

    $response = $this->getJson(
        route('collection_points.list', [
            'city' => 'São Paulo',
        ])
    );

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.city'))->toBe('São Paulo');
});

test('can filter collection points by state', function () {
    CollectionPoint::factory()->create(['state' => 'SP']);
    CollectionPoint::factory()->create(['state' => 'RJ']);

    $response = $this->getJson(
        route('collection_points.list', ['state' => 'SP'])
    );

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.state'))->toBe('SP');
});

test('can filter collection points by category', function () {
    CollectionPoint::factory()->create(['category' => 'papel']);
    CollectionPoint::factory()->create(['category' => 'vidro']);

    $response = $this->getJson(
        route('collection_points.list', ['category' => 'papel'])
    );

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.category'))->toBe('papel');
});

test('can filter collection points by user', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    CollectionPoint::factory()->create(['user_id' => $userA->id]);
    CollectionPoint::factory()->create(['user_id' => $userB->id]);

    $response = $this->getJson(
        route('collection_points.list', [
            'user_id' => $userA->id,
        ])
    );

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1);
});

test('can search collection points by name', function () {
    CollectionPoint::factory()->create([
        'name' => 'Ponto Central',
    ]);

    CollectionPoint::factory()->create([
        'name' => 'Outro Lugar',
    ]);

    $response = $this->getJson(
        route('collection_points.list', [
            'search' => 'Central',
        ])
    );

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.name'))->toContain('Central');
});