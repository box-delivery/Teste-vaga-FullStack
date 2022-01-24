<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MoviesController;
use App\Http\Controllers\Api\FavoritesController;
use App\Models\User;

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
Route::name('api.v1.')->prefix('v1')->group(function(){

    Route::post('register',[AuthController::class, 'register'])->name('register');
    Route::post('login',[AuthController::class, 'login'])->name('login');
    
    Route::middleware(['auth:sanctum'])->group(function() {
        
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');

        Route::post('logout',[AuthController::class, 'logout'])->name('logout');

        Route::name('movies.')->prefix('movies')->group(function (){
            Route::get('/list', [MoviesController::class, 'list'])->name('list');
            Route::prefix('favorites.')->name('favorites.')->prefix('favorites')->group(function(){
                Route::get('/list', [FavoritesController::class, 'list'])->name('list');
                Route::post('/toggle', [FavoritesController::class, 'toggle'])->name('toggle');
            });
        });
    });
});