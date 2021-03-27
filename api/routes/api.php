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

Route::post('login', [\App\Http\Controllers\User::class, 'login'])->name('login');

Route::resource('user', \App\Http\Controllers\User::class)->except(['create', 'edit']);

Route::group(['prefix' => 'samu', 'middleware' => 'auth:api'], function () {
    Route::post('samu', function () {
        return response()->json("seu cu", 200);
    });
});
