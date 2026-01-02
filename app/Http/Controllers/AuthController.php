<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            if(!$token = JWTAuth::attempt($credentials)) {
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
                    'user' => auth('api')->user(),
                ]
                ])->cookie(
                    'access_token', // cookie name
                    $token, 
                    60, // minutes expired
                    '/', 
                    null,
                    true, // Secure (HTTPS)
                    true, // HttpOnly (prevents XSS stealing)
                    false, 
                    'None' // Samesite
                );
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 404,
                'status_code' => 'error',
                'message' => 'Login failed',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Get the token from cookie
            $token = $request->cookie('access_token');
            // if token present 
            if($token) {
                JWTAuth::setToken($token)->invalidate();
            }

            return response()->json([
                'status' => 200,
                'status_code' => 'success',
                'message' => 'Logged out successfully'
            ])->withoutCookie('access_token');
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'status_code' => 'error',
                'message' => 'Logout failed',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 404);
        }
    }
    // public function guestAccess() {
    //     $guestUser = User::where('name', 'guest')->first();

    //     if(!$guestUser) {
    //         return response()->json('Guest user not found', 404);
    //     }

    //     $guest_token = auth('api')->login($guestUser);

    //     return response()->json($guest_token, 200);
    // }
}
