<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteMovieController;
use App\Http\Controllers\MovieController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('movies', [MovieController::class, 'index']);
    Route::patch('movies/{movie}/favorite', [FavoriteMovieController::class, 'favorite']);
    Route::patch('movies/{movie}/unfavorite', [FavoriteMovieController::class, 'unfavorite']);
    Route::get('movies/favorite', [FavoriteMovieController::class, 'index']);
});

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);
