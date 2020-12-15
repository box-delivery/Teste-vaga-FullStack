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

Route::post('user', [\App\Http\Controllers\UserController::class, 'store']);
Route::post('user/token', [\App\Http\Controllers\UserController::class, 'issueToken']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('movies', [\App\Http\Controllers\MovieController::class, 'index']);
});
