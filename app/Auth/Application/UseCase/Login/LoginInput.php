<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\Login;

use App\Auth\Infrastructure\Http\Requests\LoginRequest;

final readonly class LoginInput
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    public static function fromRequest(LoginRequest $request): self
    {
        $data = $request->validated();

        return new self(
            email: (string) $data['email'],
            password: (string) $data['password'],
        );
    }
}
