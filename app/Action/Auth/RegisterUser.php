<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\AuthException;
use App\Models\User;
use DomainException;

class RegisterUser
{
    public function execute(array $data): void
    {
        $email = $data['email'];

        if(User::where('email', $email)->exists()){
            throw new AuthException(AuthException::emailAlreadExists(), 422);
        }

        $user = User::create($data);
    }
}