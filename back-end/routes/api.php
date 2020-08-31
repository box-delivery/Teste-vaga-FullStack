<?php
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

Route::namespace('API')->group(function () {
    Route::post('/users/register', 'AuthController@register');
    Route::post('/users/login', 'AuthController@login');
    Route::post('/users/logout', 'AuthController@logout');

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::group(['prefix'=> 'movies'], function()
        {
            Route::get('/', 'MoviesController@index');
        });

        Route::group(['prefix'=> 'favorites'], function()
        {
            Route::get('/', 'FavoritesController@index');
            Route::post('/store', 'FavoritesController@store');
            Route::delete('/destroy/{id}', 'FavoritesController@destroy');
        });
    });
});
