<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtCookieAuth
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('token');

        if (!$token) {
            return response()->json(['error' => 'Token not found'], 401);
        }
        
        try {
            // Manually set the token and authenticate
            JWTAuth::setToken($token);

            if (!$user = JWTAuth::authenticate()) {
                return response()->json(['error' => 'User not found'], 401);
            }

            $user = JWTAuth::authenticate();
            auth()->guard()->setUser($user);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Exception $e) {
            // Debugging: temporarily return $e->getMessage() to see the real error
            return response()->json(['error' => 'Unauthorized: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
