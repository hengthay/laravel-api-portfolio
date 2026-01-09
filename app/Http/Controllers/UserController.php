<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() {
        try {
            // Get all user from model
            $users = User::get();

            if(!$users) {
                return $this->handleErrorResponse(null, 'User is empty', 404);
            }

            // Send response back to frontend
            return $this->handleResponse($users, 'All users retrieve successful!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
        
    }

    public function show($id) {
        try {
            $users = User::find($id);

            if(!$users) {
                return $this->handleErrorResponse(null, 'User is not found', 404);
            }

            return $this->handleResponse($users, 'Individual user get successful!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(UserRequest $request) {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($request->password);
            $users = User::create($data);


            return $this->handleResponse($users, 'User created successfully!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(UserRequest $request, $id) {
        try {
            $user = User::find($id);
            Log::debug('Update user data', ['user' => $user]);

            if (!$user) {
                return $this->handleErrorResponse(null, 'User not found', 404);
            }
            
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'role' => $request->role ?? $user->role,
                'permission' => $request->permission ?? $user->permission
            ]);

            return $this->handleResponse($user, 'User updated successfully', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->handleErrorResponse(null, 'User not found', 404);
            }

            $user->delete();

            return $this->handleResponse(null, 'User deleted successfully', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
