<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;

// Guest Routes (Only available to logged-out users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes (Only available to logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('assignments')->group(function () {
        Route::get('/', [AssignmentController::class, 'index']);
        Route::post('/', [AssignmentController::class, 'store']);
        Route::put('/{assignment}', [AssignmentController::class, 'update']);
        Route::delete('/{assignment}', [AssignmentController::class, 'destroy']);
        Route::post('/clear-all', [AssignmentController::class, 'clearAll']);
    });
});
