<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        // Get all user from model
        $users = User::get();
        // Send response back to frontend
        return $this->handleResponse($users, 'All users retrieve successful!');
    }

    public function show($id) {

    }

    public function create(Request $request) {

    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {

    }
}
