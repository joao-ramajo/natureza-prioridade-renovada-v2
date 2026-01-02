<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Action\Auth\LoginAction;
use App\Exceptions\AuthException;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;

class LoginController
{
    public function __construct(
        protected readonly LoginAction $loginAction,
    ) {}

    public function handle(LoginRequest $request)
    {
        try {
            $data = $this->loginAction->execute($request->validated());

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
