<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\Auth\RegisterUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/register', [RegisterUserController::class, 'register']);
Route::post('/login', [RegisterUserController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->prefix('person')->group(function () {
    Route::get('/', [PersonController::class, 'index']);
    Route::post('/', [PersonController::class, 'store']);
    Route::get('/{id}', [PersonController::class, 'show']);
    Route::put('/{id}', [PersonController::class, 'update']);
    Route::delete('/{id}', [PersonController::class, 'destroy']);
});

Route::post('/logout', [RegisterUserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
