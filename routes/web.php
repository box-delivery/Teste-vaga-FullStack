<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', "StartController@index")->name("index");

Route::get('movies', "MoviesController@list")->name('movies')->middleware("auth");
Route::get('favorites', "MoviesController@favorites")->name('favorites')->middleware("auth");

Route::post('addToFavorites/{id}', "MoviesController@addToFavorites")->middleware("auth");
Route::post('removeFromFavorites/{id}', "MoviesController@removeFromFavorites")->middleware("auth");

Auth::routes();
