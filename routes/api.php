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

Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');

    Route::namespace('API')->name('api.')->group(function(){
		Route::prefix('filmes')->group(function(){
			Route::get('/', 'FilmeController@index')->name('index_filmes');
			Route::get('/{id}', 'FilmeController@show')->name('single_filmes');			
			Route::post('/', 'FilmeController@store')->name('store_filmes');
			Route::put('/{id}', 'FilmeController@update')->name('update_filmes');
			Route::delete('/{id}', 'FilmeController@delete')->name('delete_filmes');
		});
	});

	Route::namespace('API')->name('api.')->group(function(){
		Route::prefix('favoritos')->group(function(){
			Route::get('/', 'FavoritoController@index')->name('index_favoritos');			
			Route::post('/', 'FavoritoController@store')->name('store_favoritos');
			Route::delete('/{id}', 'FavoritoController@delete')->name('delete_favoritos');
		});
	});
});


