<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtCookieAuth
{
    public function handle($request, Closure $next)
    {   
        try {
            // $token = $request->cookie('token');
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'status_code' => 'error',
                    'message' => 'User not found',
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
        }catch (\Exception $e) {
            // Debugging: temporarily return $e->getMessage() to see the real error
            return response()->json(['error' => 'Unauthorized: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
