<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\RegisterUser;

use App\Auth\Infrastructure\Http\Requests\RegisterUserRequest;

final readonly class RegisterUserInput
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public static function fromRequest(RegisterUserRequest $request): self
    {
        $data = $request->validated();

        return new self(
            name: (string) $data['name'],
            email: (string) $data['email'],
            password: (string) $data['password'],
        );
    }
}
