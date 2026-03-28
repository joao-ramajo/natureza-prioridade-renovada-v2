<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\RegisterUser;

use App\Auth\Application\Event\UserCreated;
use App\Auth\Application\Exception\AuthException;
use App\Auth\Domain\User;
use DomainException;

class RegisterUser
{
    public function execute(array $data): void
    {
        $email = $data['email'];

        if (User::where('email', $email)->exists()) {
            throw new AuthException(AuthException::emailAlreadExists(), 422);
        }

        $user = User::create($data);

        UserCreated::dispatch($user);
    }
}
