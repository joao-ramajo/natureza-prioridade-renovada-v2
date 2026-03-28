<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\VerifyEmail;

final readonly class VerifyEmailInput
{
    public function __construct(
        public int $userId,
        public string $hash,
    ) {
    }
}
