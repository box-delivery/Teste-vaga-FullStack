<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/movies', 'MoviesController@index');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::middleware('auth:api')->post('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'movies/favorites', 'middleware' => 'auth:api'], function () {
    Route::get('{id_user}', 'MoviesFavoritesController@index');
    Route::post('{id_user}/add/{id_movie}', 'MoviesFavoritesController@add');
    Route::delete('{id_user}/remove/{id_movie}', 'MoviesFavoritesController@remove');
});
