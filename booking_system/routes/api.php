<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\StationController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Bus feature
    Route::post('/bus', [BusController::class, 'create']);
    Route::post('/bus/update', [BusController::class, 'update']);
    Route::get('/bus', [BusController::class, 'view']);
    Route::get('/buses', [BusController::class, 'all']);
    Route::delete('/bus/delete', [BusController::class, 'delete']);

    // Station feature
    Route::post('/station', [StationController::class, 'create']);
    Route::post('/station/update', [StationController::class, 'update']);
    Route::get('/station', [StationController::class, 'view']);
    Route::get('/stations', [StationController::class, 'all']);
    Route::delete('/station/delete', [StationController::class, 'delete']);




    Route::post('logout', [AuthController::class, 'logout']);
});
