<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\VerifyEmail;

final readonly class VerifyEmailOutput
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
