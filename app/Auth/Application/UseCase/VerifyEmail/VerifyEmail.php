<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase\VerifyEmail;

use App\Auth\Domain\Entity\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyEmail
{
    public function execute(VerifyEmailInput $input): VerifyEmailOutput
    {
        $user = User::findOrFail($input->userId);

        if (! hash_equals($input->hash, sha1($user->email))) {
            throw new HttpException(403, 'Link inválido');
        }

        if ($user->hasVerifiedEmail()) {
            return new VerifyEmailOutput('Email já verificado,');
        }

        $user->markEmailAsVerified();

        return new VerifyEmailOutput('Email verificado com sucesso.');
    }
}
