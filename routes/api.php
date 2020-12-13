<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PassportAuthController;
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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('movies', [MovieController::class, 'index']);
    Route::post('favorite', [MovieController::class, 'favoriteMovie']);
    Route::get('favorites', [MovieController::class, 'listFavorites']);
    Route::delete('favorite', [MovieController::class, 'deleteFavoriteMovie']);

});
