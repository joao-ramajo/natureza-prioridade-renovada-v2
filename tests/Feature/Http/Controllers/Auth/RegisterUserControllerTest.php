<?php

test('cria um usuário com sucesso', function () {
    $data = [
        'name' => 'John doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'Aa123123',
        'password_confirmation' => 'Aa123123'
    ];

    $response = $this->post(route('auth.register'), $data);
    $response->dump();

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'email' => $data['email']
    ]);
});
