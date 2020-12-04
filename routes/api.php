<?php

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

Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth_login');
});

Route::prefix('users')->group(function () {
    Route::post('', [\App\Http\Controllers\UserController::class, 'create'])->name('user_create');
});

Route::middleware('auth:api')->group(function () {
    Route::get('movies', [\App\Http\Controllers\MovieController::class, 'list'])->name('movie_list');

    Route::prefix('users/current')->group(function () {
        Route::get('movies', [\App\Http\Controllers\MovieListController::class, 'list'])->name('user_movie_list');
        Route::put('movies', [\App\Http\Controllers\MovieListController::class, 'put'])->name('user_movie_put');
        Route::delete('movies/{movie_id}', [\App\Http\Controllers\MovieListController::class, 'delete'])->name('user_movie_delete');
    });
});
