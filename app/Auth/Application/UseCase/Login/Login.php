<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Login;

use App\Auth\Application\Exception\AuthException;
use App\Auth\Domain\Entity\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login
{
    public function execute(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new AuthException(AuthException::invalidCredentials(), 401);
        }

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
