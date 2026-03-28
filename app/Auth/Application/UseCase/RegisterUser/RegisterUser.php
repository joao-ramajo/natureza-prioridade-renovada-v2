<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\RegisterUser;

use App\Auth\Domain\Event\UserCreated;
use App\Auth\Application\Exception\AuthException;
use App\Auth\Domain\Entity\User;

class RegisterUser
{
    public function execute(RegisterUserInput $input): RegisterUserOutput
    {
        $email = $input->email;

        if (User::where('email', $email)->exists()) {
            throw new AuthException(AuthException::emailAlreadExists(), 422);
        }

        $user = User::create([
            'name' => $input->name,
            'email' => $input->email,
            'password' => $input->password,
        ]);

        UserCreated::dispatch($user);

        return new RegisterUserOutput('Conta registrada com sucesso !');
    }
}
