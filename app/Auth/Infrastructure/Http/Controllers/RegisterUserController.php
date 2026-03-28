<?php

namespace App\Auth\Infrastructure\Http\Controllers;

use App\Auth\Application\Exception\AuthException;
use App\Auth\Application\UseCase\RegisterUser\RegisterUser;
use App\Auth\Application\UseCase\RegisterUser\RegisterUserInput;
use App\Auth\Infrastructure\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterUserController extends Controller
{
    public function __construct(
        protected readonly RegisterUser $registerUser,
    ) {
    }

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        try {
            $output = $this->registerUser->execute(RegisterUserInput::fromRequest($request));

            return new JsonResponse($output->toArray(), 201);
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
