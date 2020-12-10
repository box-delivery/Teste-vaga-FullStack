<?php

use App\Http\Controllers\Api\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UsersController;
use \App\Http\Controllers\Api\AuthController;

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


Route::post("auth/login", [ AuthController::class, "login" ])->name("auth.login");
Route::post("auth/logout", [ AuthController::class, "logout" ])->name("auth.logout");
Route::post("auth/refresh", [ AuthController::class, "refresh" ])->name("auth.refresh");

Route::middleware(["apiJWT", "ACL Permissões"])->group(function(){

    # Grupo de Rotas de Usuários
    Route::prefix("user/")->name("user.")->group(function (){

        Route::get("index", [ UsersController::class, "index" ])
            ->name("index")
            ->setWheres([
                "label"        =>"Lista de ",
                "group"        =>"Usuários",
                "roles_ids"    =>"3",
            ]);

        Route::post("store", [ UsersController::class, "store" ])
            ->name("store")
            ->setWheres([
                "label"        =>"Cadastrar ",
                "group"        =>"Usuários",
                "roles_ids"    =>"3",
            ]);

    });

    # Grupo de Rotas de Filmes
    Route::prefix("movie/")->name("movie.")->group(function (){

        Route::get("index/{paginate?}", [ MovieController::class, "index" ])
            ->name("index")
            ->setWheres([
                "label"        =>"Lista de ",
                "group"        =>"Filmes",
                "roles_ids"    =>"3",
            ]);

        Route::get("favorite/{movie_id?}", [ MovieController::class, "favorite" ])
            ->name("favorite")
            ->setWheres([
                "label"        =>"Favoritar ",
                "group"        =>"Filmes",
                "roles_ids"    =>"3",
            ]);

        Route::get("listFavorite", [ MovieController::class, "listFavorite" ])
            ->name("listFavorite")
            ->setWheres([
                "label"        =>"Lista de ",
                "group"        =>"Favoritos",
                "roles_ids"    =>"3",
            ]);

        Route::get("deleteFavorite/{movie_id?}", [ MovieController::class, "deleteFavorite" ])
            ->name("deleteFavorite")
            ->setWheres([
                "label"        =>"Deletar dos ",
                "group"        =>"Favoritos",
                "roles_ids"    =>"3",
            ]);

    });

});
