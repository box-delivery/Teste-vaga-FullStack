<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'AutenticadorControlador@index');
Route::get('/cadastro','AutenticadorControlador@cadastro');
Auth::routes();


Route::prefix('filmes')->group(function(){
      Route::get('/','filmesCtrl@index');
      Route::get('/favoritos','user_filmeCtrl@favoritos');
      Route::get('/cria','filmesCtrl@cria');
      Route::post('/cadastrar','filmesCtrl@cadastrar');
      Route::get('/generos','generoCtrl@cria');
      Route::post('/generos/criar','generoCtrl@CriaGenero');
});
    
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');



   ;

    Route::get('/user',function(){return Auth::user();});
});
*/