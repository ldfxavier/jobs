<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectedRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException):
                return response([
                    'message' => 'Token inválido!',
                ], 401);
            elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException):
                return response([
                    'message' => 'Token expirado!',
                ], 401);
            else:
                return response([
                    'message' => 'Token não encontrado!',
                ], 401);
            endif;
        }
        return $next($request);
    }
}
