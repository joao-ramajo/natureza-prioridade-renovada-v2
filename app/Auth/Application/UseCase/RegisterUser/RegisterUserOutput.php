<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\RegisterUser;

final readonly class RegisterUserOutput
{
    public function __construct(
        public string $message,
    ) {
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
