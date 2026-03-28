<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Login;

use App\Auth\Application\Exception\AuthException;
use App\Auth\Domain\Entity\User;
use Illuminate\Support\Facades\Hash;

class Login
{
    public function execute(LoginInput $input): LoginOutput
    {
        $user = User::where('email', $input->email)->first();

        if (!$user || !Hash::check($input->password, $user->password)) {
            throw new AuthException(AuthException::invalidCredentials(), 401);
        }

        $token = $user->createToken('api')->plainTextToken;

        return new LoginOutput(
            accessToken: $token,
            tokenType: 'Bearer',
            userEmail: (string) $user->email,
            userName: (string) $user->name,
        );
    }
}
