<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Http\Controllers;

use App\Auth\Application\Exception\AuthException;
use App\Auth\Application\UseCase\Login\Login;
use App\Auth\Application\UseCase\Login\LoginInput;
use App\Auth\Infrastructure\Http\Requests\LoginRequest;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController
{
    public function __construct(
        protected readonly Login $login,
    ) {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $output = $this->login->execute(LoginInput::fromRequest($request));

            return response()->json($output->toArray(), 200);
        } catch (AuthException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => 'Erro interno do servidor.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
