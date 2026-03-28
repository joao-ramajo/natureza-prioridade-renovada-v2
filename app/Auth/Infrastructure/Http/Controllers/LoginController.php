<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Http\Controllers;

use App\Auth\Application\UseCase\Login\Login;
use App\Auth\Application\Exception\AuthException;
use App\Auth\Infrastructure\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;

class LoginController
{
    public function __construct(
        protected readonly Login $login,
    ) {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $data = $this->login->execute($request->validated());

            $payload = [
                'access_token' => $data['token'],
                'token_type' => 'Bearer',
                'user' => [
                    'email' => $data['user']['email'],
                    'name' => $data['user']['name']
                ],
            ];
            return response()->json($payload, 200);
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
