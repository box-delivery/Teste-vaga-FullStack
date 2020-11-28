<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', [\App\Domain\Users\Controllers\AuthController::class, 'login']);

Route::post('users', [\App\Domain\Users\Controllers\UserController::class, 'store']);
