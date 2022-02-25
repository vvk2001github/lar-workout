<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::resource('exercise', \App\Http\Controllers\ExerciseController::class);
Route::resource('workout', \App\Http\Controllers\WorkoutController::class);
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('/admin/index', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');;
