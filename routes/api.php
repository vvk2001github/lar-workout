<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\AuthController;
use \App\Http\Controllers\API\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('auth/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('me', [ApiController::class, 'me']);
Route::middleware('auth:sanctum')->post('/userlist', [ApiController::class, 'userList']);
Route::middleware('auth:sanctum')->post('/exercises', [ApiController::class, 'exercisesList'])->name('api.exercise.list');
Route::middleware('auth:sanctum')->post('/exercisesdata', [ApiController::class, 'exercisesData'])->name('api.exercise.data');
