<?php

use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// public route
// Route::get('/user', [AuthController::class, 'index'])->middleware('jwt.auth');
// throttle is used to limit a maximum request only 15 requests per 1 minute from the same client (IP / User)
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:15,1');
Route::post('/logout', [AuthController::class, 'logout']);
// Route::post('/guest', [AuthController::class, 'guestAccess'])->middleware('throttle:15,1');

// The middleware name must be matching with alias name that we used in Kernel or boostrap/app.php file.
Route::middleware('jwt.cookie')->get('/check-auth', function () {
    return response()->json([
        'ok' => true,
        // 'user' => Auth::user()
    ]);
});

Route::middleware(['jwt.cookie'])->group(function() {
    Route::controller(SkillsController::class)->prefix('skills')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(ExperiencesController::class)->prefix('experiences')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(EducationController::class)->prefix('educations')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(UserController::class)->prefix('users')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(AchievementsController::class)->prefix('achievements')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(BlogsController::class)->prefix('blogs')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
    Route::controller(ProfileController::class)->prefix('profiles')->group(function() {
        Route::get('/', "index");
        Route::get('/{id}', "show");
        Route::post('/', "create");
        Route::put('/{id}', "update");
        Route::delete("/{id}", "delete");
    });
});