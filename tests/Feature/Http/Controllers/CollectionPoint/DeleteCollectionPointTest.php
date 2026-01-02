<?php

use App\Models\User;
use App\Models\CollectionPoint;
use Laravel\Sanctum\Sanctum;

test('user can delete own collection point', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $collectionPoint = CollectionPoint::factory()
        ->for($user)
        ->create();

    $response = $this->deleteJson(
        route('collection_points.delete', $collectionPoint->uuid)
    );
    
    $response->dump();

    $response
        ->assertOk()
        ->assertJson([
            'message' => 'Ponto de coleta removido com sucesso.',
        ]);

    $this->assertDatabaseMissing('collection_points', [
        'uuid' => $collectionPoint->uuid,
    ]);
});
