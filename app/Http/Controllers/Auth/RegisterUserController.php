<?php

namespace App\Http\Controllers\Auth;

use App\Action\Auth\RegisterUser;
use App\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterUserController extends Controller
{
    public function __construct(
        protected readonly RegisterUser $registerUserAction,
        // protected readonly Log $log, 
    ) {}

    public function handle(RegisterUserRequest $request)
    {
        try {
            $this->registerUserAction->execute($request->validated());
            return new JsonResponse([
                'message' => 'Conta registrada com sucesso !'
            ], 201);
        } catch (AuthException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch(Exception $e){
            return new JsonResponse([
                'message' => 'Erro interno do servidor.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
