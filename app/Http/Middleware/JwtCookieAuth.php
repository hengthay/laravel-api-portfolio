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
            $user = JWTAuth::authenticate();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }

            // Add an explicit check to satisfy PHPStan's type requirements
            if ($user instanceof \Illuminate\Contracts\Auth\Authenticatable) {
                auth()->guard()->setUser($user);
            } else {
                return response()->json(['error' => 'Invalid user type'], 401);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Exception $e) {
            // Debugging: temporarily return $e->getMessage() to see the real error
            return response()->json(['error' => 'Unauthorized: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
