<?php

namespace App\Http\Middleware;

use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $token = substr($authHeader, 7);
        $userId = app(JwtService::class)->parseToken($token);

        if (!$userId) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        auth()->loginUsingId($userId); // autentica o usuário manualmente

        return $next($request);
    }
}
