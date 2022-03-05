<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

//Admin
Route::get('/admin/index', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::post('/admin/storeuser', [\App\Http\Controllers\AdminController::class, 'storeuser'])->name('admin.storeuser')->middleware('auth');
Route::post('/admin/deleteuser', [\App\Http\Controllers\AdminController::class, 'deleteuser'])->name('admin.deleteuser')->middleware('auth');
Route::post('/admin/setpassuser', [\App\Http\Controllers\AdminController::class, 'setpassuser'])->name('admin.setpassuser')->middleware('auth');

//Facebook
Route::get('/auth/facebook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});
Route::get('/auth/facebook/callback',  [\App\Http\Controllers\FacebookController::class, 'fbCallback']);
