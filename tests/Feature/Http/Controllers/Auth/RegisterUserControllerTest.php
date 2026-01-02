<?php

test('cria um usuário com sucesso', function () {
    $data = [
        'name' => 'John doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'Aa123123',
        'password_confirmation' => 'Aa123123'
    ];

    $response = $this->post(route('auth.register'), $data);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'email' => $data['email']
    ]);
});

test('não permite criar um usuário com email que já esta sendo utilizado', function() {
    $data = [
        'name' => 'John doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'Aa123123',
        'password_confirmation' => 'Aa123123'
    ];

    $this->post(route('auth.register'), $data);

    $response = $this->post(route('auth.register'), $data);

    $response->assertStatus(422);
});

test('não permite criar uma conta com a senha diferente da confirmação', function() {
    $data = [
        'name' => 'John doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'Aa123123',
        'password_confirmation' => 'Aa321321'
    ];

    $response = $this->post(route('auth.register', $data));

    $response->assertStatus(302);
});