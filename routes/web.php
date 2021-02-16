<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\FavoritesController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->name('movies.')->prefix('movies')->group(function (){
    Route::get('/list', [MoviesController::class,'list'])->name('list');
    Route::prefix('favorites.')->name('favorites.')->prefix('favorites')->group(function(){
        Route::get('/list', [FavoritesController::class, 'list'])->name('list');
        Route::post('/toggle', [FavoritesController::class, 'toggle'])->name('toggle');
    });
});
