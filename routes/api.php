<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->get('/check-auth', function () {
    return response()->json(['ok' => true]);
});

Route::middleware('auth:api')->group(function() {
    Route::controller(SkillsController::class)->prefix('skill')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
});

Route::get('/user', [AuthController::class, 'index']);
// throttle is used to limit a maximum request only 15 requests per 1 minute from the same client (IP / User)
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:15,1');
Route::post('/logout', [AuthController::class, 'logout']);
// Route::post('/guest', [AuthController::class, 'guestAccess'])->middleware('throttle:15,1');