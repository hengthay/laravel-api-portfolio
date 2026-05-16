<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function index() {
        // Get all user from model
        $users = User::get();
        
        // Send response back to frontend
        return $this->handleResponse($users, 'All users retrieve successful!');
    }

    public function login(Request $request) {
        try {
            // Storing or get only name and password from frontend
            $credentials = $request->validate([
                'name'    => 'required|string',
                'password' => 'required|string',
            ]);
            // Check if name + password match a user
            // If yes generate token, otherwise return false
            $token = JWTAuth::attempt($credentials);

            if(!$token) {
                return response()->json([
                    'status_code' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Send back as JSON format
            return response()->json([
                'status_code' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user' => JWTAuth::user(),
                    'token' => $token,
                    'token_type' => "bearer",
                ]
                ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'status_code' => 'error',
                'message' => 'Login failed',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Get the token from Authorization Header and validate
            JWTAuth::parseToken()->authenticate();

            // Destroy token or remove
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'status' => 200,
                'status_code' => 'success',
                'message' => 'Logged out successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'status_code' => 'error',
                'message' => 'Logout failed',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 500);
        }
    }

    // public function refresh(Request $request) {
    //     try {
    //         $token = $request->hasCookie('access_token');

    //         if(!$token) {
    //             return response()->json([
    //                 'status code' => 'error',
    //                 'message' => 'Token not found!'
    //             ], 401);
    //         }

    //         JWTAuth::setToken($token);
    //         $newToken = JWTAuth::refresh();

    //         return response()->json([
    //             'status_code' => 'success',
    //             'message' => 'Token refreshed successfully'
    //         ])->cookie(
    //             'access_token',
    //             $newToken,
    //             60,
    //             '/',
    //             null,
    //             config('app.env') === 'production',
    //             true,
    //             false,
    //             'None'
    //         );
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }
    // public function guestAccess() {
    //     $guestUser = User::where('name', 'guest')->first();

    //     if(!$guestUser) {
    //         return response()->json('Guest user not found', 404);
    //     }

    //     $guest_token = auth('api')->login($guestUser);

    //     return response()->json($guest_token, 200);
    // }
}
