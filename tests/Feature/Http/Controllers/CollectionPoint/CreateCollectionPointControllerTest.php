<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;

test('authenticated user can create a collection point', function () {
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
});
