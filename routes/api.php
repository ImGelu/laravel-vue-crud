<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/auth', function (Request $request) {
        return $request->user();
    });
    Route::get('/v1/logout', [AuthController::class, 'logout']);

    Route::post('/v1/books', [BookController::class, 'store']);
    Route::get('/v1/books/{id?}', [BookController::class, 'show']);
    Route::put('/v1/books/{id}', [BookController::class, 'update']);
    Route::delete('/v1/books/{id}', [BookController::class, 'destroy']);

    Route::post('/v1/authors', [AuthorController::class, 'store']);
    Route::get('/v1/authors/{id?}', [AuthorController::class, 'show']);
    Route::put('/v1/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/v1/authors/{id}', [AuthorController::class, 'destroy']);
});

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/register', [AuthController::class, 'register']);
