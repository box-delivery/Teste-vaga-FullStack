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

Route::middleware('jwt:api')->group(function() {

	Route::prefix('movies')->group(function() {

		// Rota padrões dos filmes
		Route::get('/', 			'App\Http\Controllers\Api\MoviesController@index');
   		Route::put('/', 			'App\Http\Controllers\Api\MoviesController@store');

   		// Rotas para favoritos do usuário
   		Route::prefix('favorite')->group(function() {
   			Route::get('/', 				'App\Http\Controllers\Api\FavoritesController@index');
			Route::put('/{movie_id}', 		'App\Http\Controllers\Api\FavoritesController@store');
   			Route::delete('/{movie_id}', 	'App\Http\Controllers\Api\FavoritesController@delete');
   		});

   	});

});