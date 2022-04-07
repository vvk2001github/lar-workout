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

#API
Route::middleware('auth:sanctum')->post('/userlist', [ApiController::class, 'userList']);
#Exercises
Route::middleware('auth:sanctum')->post('/exercises', [ApiController::class, 'exercisesList'])->name('api.exercise.list');
Route::middleware('auth:sanctum')->post('/exercisesdata', [ApiController::class, 'exercisesData'])->name('api.exercise.data');

Route::middleware('auth:sanctum')->post('/exercises/index', [ApiController::class, 'exerciseIndex'])->name('api.exercise.index');
Route::middleware('auth:sanctum')->post('/exercises/store', [ApiController::class, 'exerciseStore'])->name('api.exercise.store');
Route::middleware('auth:sanctum')->post('/exercises/destroy', [ApiController::class, 'exerciseDestroy'])->name('api.exercise.destroy');
Route::middleware('auth:sanctum')->post('/exercises/update', [ApiController::class, 'exerciseUpdate'])->name('api.exercise.update');

Route::middleware('auth:sanctum')->post('/workouts/index', [ApiController::class, 'workoutsIndex'])->name('api.workouts.index');
Route::middleware('auth:sanctum')->post('/workouts/update', [ApiController::class, 'workoutsUpdate'])->name('api.workouts.update');
