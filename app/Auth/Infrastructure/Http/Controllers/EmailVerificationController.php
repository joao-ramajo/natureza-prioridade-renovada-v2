<?php

namespace App\Auth\Infrastructure\Http\Controllers;

use App\Auth\Application\UseCase\VerifyEmail\VerifyEmail;
use App\Auth\Application\UseCase\VerifyEmail\VerifyEmailInput;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EmailVerificationController extends Controller
{
    public function __construct(
        protected readonly VerifyEmail $verifyEmail,
    ) {
    }

    public function __invoke($id, $hash)
    {
        try {
            $output = $this->verifyEmail->execute(new VerifyEmailInput(
                userId: (int) $id,
                hash: (string) $hash,
            ));

            return response()->json([
                ...$output->toArray(),
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }
}
