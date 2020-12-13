<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/search', 'HomeController@search')->name('home.search');
Route::get('/searchTerm', 'HomeController@searchTerm')->name('home.searchTerm');

Route::post('/users/tagCreate', 'UserTagsController@tagCreate');

Route::resource('/users', 'UserTagsController');
