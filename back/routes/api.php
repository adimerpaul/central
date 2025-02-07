<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout']);
    Route::get('/me', [App\Http\Controllers\UserController::class, 'me']);


    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store']);
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);
    Route::put('/updatePassword/{user}', [App\Http\Controllers\UserController::class, 'updatePassword']);
//    permissions
    Route::get('/permissions', [App\Http\Controllers\UserController::class, 'permissions']);
//    permissions
    Route::post('/permissions/{user}', [App\Http\Controllers\UserController::class, 'permissionsStore']);


    Route::get('/conceptos', [App\Http\Controllers\ConceptoController::class, 'index']);

    Route::get('/pagos', [App\Http\Controllers\PagoConceptoController::class, 'index']);
    Route::put('/pagos/{pago}', [App\Http\Controllers\PagoConceptoController::class, 'update']);
    Route::post('/pagoconcepto', [App\Http\Controllers\PagoConceptoController::class, 'store']);
});
