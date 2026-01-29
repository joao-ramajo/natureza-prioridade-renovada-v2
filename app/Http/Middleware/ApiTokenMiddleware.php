<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-API-KEY');

        if ($this->isDevelopment()) {
            return $next($request);
        }

        if (!$token) {
            return response()->json([
                'message' => 'Acesso não autorizado, entre em contato com o suporte'
            ], 401);
        }

        $tokenHash = hash('sha256', $token);

        $apiToken = ApiToken::where('token', $tokenHash)
            ->where('active', true)
            ->whereFuture('expires_at')
            ->first();

        if (!$apiToken) {
            return response()
                ->json([
                    'message' => 'Token inválido ou expirado.'
                ], 201);
        }

        $apiToken->update([
            'last_used_at' => now(),
        ]);

        Context::add('api_client', $apiToken);

        return $next($request);
    }

    private function isDevelopment(): bool
    {
        $ignoredEnvironments = ['local', 'testing'];

        return in_array(app()->environment(), $ignoredEnvironments, true);
    }
}
