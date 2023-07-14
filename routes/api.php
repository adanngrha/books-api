<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::delete('logout', [UserController::class, 'logout']);

    // Books
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'all']);
        Route::post('add', [BookController::class, 'add']);
        Route::put('{id}/edit', [BookController::class, 'edit']);
        Route::get('{id}', [BookController::class, 'detail']);
        Route::delete('{id}', [BookController::class, 'destroy']);
    });

});
