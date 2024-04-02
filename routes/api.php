<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiEventoPersonalController;
use App\Http\Controllers\ApiCitaController;
use App\Http\Controllers\ApiPublicacionController;
use App\Http\Controllers\ApiAuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::get('me', [ApiAuthController::class, 'me']);
});

Route::get('/users', [ApiUserController::class, 'index']);
Route::post('/users', [ApiUserController::class, 'store']);
Route::get('/users/{user}', [ApiUserController::class, 'show']);
Route::put('/users/{user}', [ApiUserController::class, 'update']);
Route::delete('/users/{user}', [ApiUserController::class, 'destroy']);

Route::get('/eventos_personales', [ApiEventoPersonalController::class, 'index']);
Route::post('/eventos_personales', [ApiEventoPersonalController::class, 'store']);
Route::get('/eventos_personales/{id}', [ApiEventoPersonalController::class, 'show']);
Route::put('/eventos_personales/{id}', [ApiEventoPersonalController::class, 'update']);
Route::delete('/eventos_personales/{id}', [ApiEventoPersonalController::class, 'destroy']);

Route::get('/citas', [ApiCitaController::class, 'index']);
Route::post('/citas', [ApiCitaController::class, 'store']);
Route::get('/citas/{id}', [ApiCitaController::class, 'show']);
Route::put('/citas/{id}', [ApiCitaController::class, 'update']);
Route::delete('/citas/{id}', [ApiCitaController::class, 'destroy']);

Route::get('/publicaciones', [ApiPublicacionController::class, 'index']);
Route::post('/publicaciones', [ApiPublicacionController::class, 'store']);
Route::get('/publicaciones/{id}', [ApiPublicacionController::class, 'show']);
Route::put('/publicaciones/{id}', [ApiPublicacionController::class, 'update']);
Route::delete('/publicaciones/{id}', [ApiPublicacionController::class, 'destroy']);