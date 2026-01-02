<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtCookieAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!$request->hasCookie('access_token')) {
                return response()->json([
                    'status_code' => 'error',
                    'message' => 'Token not found'
                ], 401);
            }

            $token = $request->cookie('access_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                return response()->json([
                    'status_code' => 'error',
                    'message' => 'User not found'
                ], 401);
            }

            auth('api')->setUser($user);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'status_code' => 'error',
                'message' => 'Token expired'
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'status_code' => 'error',
                'message' => 'Token invalid'
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'status_code' => 'error',
                'message' => 'Token error: ' . $e->getMessage()
            ], 401);
        }

        return $next($request);
    }
}
