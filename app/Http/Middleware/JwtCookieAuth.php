<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtCookieAuth
{
    public function handle($request, Closure $next)
    {   
        try {
            // $token = $request->cookie('token');
            $user = JWTAuth::parseToken()->authenticate();

            // instanceof check narrows type for PHPStan
            if (!$user instanceof \Illuminate\Contracts\Auth\Authenticatable) {
                return response()->json([
                    'status_code' => 'error',
                    'message'     => 'User not found'
                ], 401);
            }

            // Set the authenticated user for this request
            Auth::setUser($user);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'status_code' => 'error',
                'message'     => 'Token expired'
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'status_code' => 'error',
                'message'     => 'Token invalid'
            ], 401);
        } catch (JWTException $e) {
            // Covers missing/malformed Authorization header
            return response()->json([
                'status_code' => 'error',
                'message'     => 'Token absent'
            ], 401);
        }

        return $next($request);
    }
}
