<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Login;

final readonly class LoginOutput
{
    public function __construct(
        public string $accessToken,
        public string $tokenType,
        public string $userEmail,
        public string $userName,
    ) {
    }

    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => $this->tokenType,
            'user' => [
                'email' => $this->userEmail,
                'name' => $this->userName,
            ],
        ];
    }
}
