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


Route::group(['middleware' => 'auth:api', 'prefix' => 'movies'], function() {
    Route::get('/', [MovieController::class, 'index']);
    Route::get('favorites', [MovieController::class, 'listFavorites']);
    Route::post('favorite', [MovieController::class, 'favoriteMovie']);
    Route::delete('favorite', [MovieController::class, 'deleteFavoriteMovie']);

});
