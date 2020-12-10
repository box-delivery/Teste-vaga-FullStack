<?php

use App\Http\Controllers\Panel\GenresController;
use App\Http\Controllers\Panel\MoviesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Panel\MainController;
use \App\Http\Controllers\Panel\UserController;
use \App\Http\Controllers\Panel\RoleController;
use \App\Http\Controllers\Panel\PermissionController;
use \App\Http\Controllers\Site\MainController as SiteMainController;
use \App\Http\Controllers\Site\TermsController;
use \App\Http\Controllers\System\HitsPagesController;
use Illuminate\Support\Facades\View;
use \App\Http\Controllers\Panel\DataTableServerSideController;
use \App\Http\Controllers\ApiDocumentation\MainController as ApiMainController;

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

/**
 * Insert variables globals
 */
View::composer('*', function($view)
{
    $routeCurrent = Route::getCurrentRoute();
    $routesAllView = \App\Http\Middleware\ACLPermissions::exceptionRoutes();
    $routeActive = Route::currentRouteName();
    $route = explode('.', $routeActive);
    $routeAmbient         = $route[0] ?? null;
    $routeCrud            = $route[1] ?? null;
    $routeMethod          = $route[2] ?? null;

    $view
        ->with('routeCurrent', $routeCurrent)
        ->with('routesAllView', $routesAllView)
        ->with('routeActive', $routeActive)
        ->with('routeAmbient', $routeAmbient)
        ->with('routeCrud', $routeCrud)
        ->with('routeMethod', $routeMethod);
});

// Middleware de permissões de ACL e de usuário logado
Route::middleware("ACL Permissões")->group(function (){

    Route::namespace('site')->name('site.')->group(function (){

        // Grupo de Rotas do Controller "Main"
        Route::name('main.')->group(function (){

            Route::get('/', [ SiteMainController::class, "index" ])
                ->name('index');

        });

        Route::name('terms.')->group(function (){

            Route::get('/terms', [ TermsController::class, "index" ])
                ->name('index');

        });

    });

    Route::namespace('apiDocumentation')->name('apiDocumentation.')->group(function (){

        // Grupo de Rotas do Controller "Main"
        Route::name('main.')->group(function (){

            Route::get('/apiDocumentation', [ ApiMainController::class, "index" ])
                ->name('index');

        });

    });

    Auth::routes();

    // Middleware de usuário logado
    Route::middleware("auth")->group(function (){

        // Middleware de descrição da permissão
        Route::name("panel.")->group(function (){

            Route::post('dataTableServerSide/init', [ DataTableServerSideController::class, "init" ])
                ->name('dataTableServerSide.init');

            // Grupo de Rotas do Controller "Main"
            Route::name("main.")->group(function (){

                Route::get('/painel-de-controle', [ MainController::class, "index" ])
                    ->name('index')
                    ->setWheres([
                        "label"        =>"Página Principal do ",
                        "group"        =>"Painel de Controle",
                        "roles_ids"    =>"all",
                    ]);

                Route::get('/system', [ MainController::class, "system" ])
                    ->name('system')
                    ->setWheres([
                        "label"        =>"Página de Configuração do ",
                        "group"        =>"Sistema",
                        "roles_ids"    =>"null",
                    ]);

            });

            // Grupo de Rotas do Controller "Users"
            Route::prefix('user/')->name('user.')->group(function (){

                Route::get('index', [ UserController::class, "index" ])
                    ->name('index')
                    ->setWheres([
                        "label"        =>"Visualizar página de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('create', [ UserController::class, "create" ])
                    ->name('create')
                    ->setWheres([
                        "label"        =>"Página de Criação de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('store', [ UserController::class, "store" ])
                    ->name('store')
                    ->setWheres([
                        "label"        =>"Ação de Criação de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('edit/{id?}', [ UserController::class, "edit" ])
                    ->name('edit')
                    ->setWheres([
                        "label"        =>"Página de Edição de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('permissionToExchangePassword', [ UserController::class, "permissionToExchangePassword" ])
                    ->name('permissionToExchangePassword')
                    ->setWheres([
                        "label"        =>"Troca de  ",
                        "group"        =>"Senha",
                        "roles_ids"    =>"all",
                    ]);

                Route::post('update', [ UserController::class, "update" ])
                    ->name('update')
                    ->setWheres([
                        "label"        =>"Ação de Edição de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('delete/{id?}', [ UserController::class, "delete" ])
                    ->name('delete')
                    ->setWheres([
                        "label"        =>"Ação de Exclusão de ",
                        "group"        =>"Usuários",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('dataTableServerSide', [ UserController::class, "dataTableServerSide" ])
                    ->name('dataTableServerSide');

                Route::post('permissionToExchangePassword', [ UserController::class, "permissionToExchangePassword" ])
                    ->name('permissionToExchangePassword')
                    ->setWheres([
                        "label"        =>"Troca de  ",
                        "group"        =>"Senha",
                        "roles_ids"    =>"all",
                    ]);

            });

            // Grupo de Rotas do Controller "Roles"
            Route::prefix('role/')->name('role.')->group(function (){

                Route::get('index', [ RoleController::class, "index" ])
                    ->name('index')
                    ->setWheres([
                        "label"        =>"Visualizar página de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('create', [ RoleController::class, "create" ])
                    ->name('create')
                    ->setWheres([
                        "label"        =>"Página de Criação de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('store', [ RoleController::class, "store" ])
                    ->name('store')
                    ->setWheres([
                        "label"        =>"Ação de Criação de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('edit/{id?}', [ RoleController::class, "edit" ])
                    ->name('edit')
                    ->setWheres([
                        "label"        =>"Página de Edição de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('update', [ RoleController::class, "update" ])
                    ->name('update')
                    ->setWheres([
                        "label"        =>"Ação de Edição de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('delete/{id?}', [ RoleController::class, "delete" ])
                    ->name('delete')
                    ->setWheres([
                        "label"        =>"Ação de Exclusão de ",
                        "group"        =>"Funções",
                        "roles_ids"    =>"null",
                    ]);

            });

            // Grupo de Rotas do Controller "Permissions"
            Route::prefix('permission/')->name('permission.')->group(function (){

                Route::get('index', [ PermissionController::class, "index" ])
                    ->name('index')
                    ->setWheres([
                        "label"        =>"Visualizar página ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('create', [ PermissionController::class, "create" ])
                    ->name('create')
                    ->setWheres([
                        "label"        =>"Página de Criação de ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('store', [ PermissionController::class, "store" ])
                    ->name('store')
                    ->setWheres([
                        "label"        =>"Ação de Criação de ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('edit/{id?}', [ PermissionController::class, "edit" ])
                    ->name('edit')
                    ->setWheres([
                        "label"        =>"Página de Edição de ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

                Route::post('update', [ PermissionController::class, "update" ])
                    ->name('update')
                    ->setWheres([
                        "label"        =>"Ação de Edição de ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

                Route::get('delete/{id?}', [ PermissionController::class, "delete" ])
                    ->name('delete')
                    ->setWheres([
                        "label"        =>"Ação de Exclusão de ",
                        "group"        =>"Permissões",
                        "roles_ids"    =>"null",
                    ]);

            });

            // Grupo de Rotas do Controller "Movies"
            Route::prefix('movie/')->name('movie.')->group(function (){

                Route::get('favoriteList', [ MoviesController::class, "favoriteList" ])
                    ->name('favoriteList')
                    ->setWheres([
                        "label"        =>"Lista de Favoritos de ",
                        "group"        =>"Filmes",
                        "roles_ids"    =>"2,3",
                    ]);

                Route::get('list/{genre_id?}', [ MoviesController::class, "list" ])
                    ->name('list')
                    ->setWheres([
                        "label"        =>"Lista de ",
                        "group"        =>"Filmes",
                        "roles_ids"    =>"2,3",
                    ]);

                Route::post('search', [ MoviesController::class, "search" ])
                    ->name('search')
                    ->setWheres([
                        "label"        =>"Busca de ",
                        "group"        =>"Filmes",
                        "roles_ids"    =>"2,3",
                    ]);

                Route::get('favorite/{movie_id?}', [ MoviesController::class, "favorite" ])
                    ->name('favorite')
                    ->setWheres([
                        "label"        =>"Favoritar ",
                        "group"        =>"Filme",
                        "roles_ids"    =>"2",
                    ]);

                Route::get('deleteFavorite/{movie_id?}', [ MoviesController::class, "deleteFavorite" ])
                    ->name('deleteFavorite')
                    ->setWheres([
                        "label"        =>"Desfavoritar ",
                        "group"        =>"Filme",
                        "roles_ids"    =>"2",
                    ]);

                Route::get('info/{movie_id?}', [ MoviesController::class, "info" ])
                    ->name('info')
                    ->setWheres([
                        "label"        =>"Informações do ",
                        "group"        =>"Filme",
                        "roles_ids"    =>"2,3",
                    ]);

            });

            // Grupo de Rotas do Controller "Movies"
            Route::prefix('genre/')->name('genre.')->group(function (){

                Route::get('list', [ GenresController::class, "list" ])
                    ->name('list')
                    ->setWheres([
                        "label"        =>"Lista de ",
                        "group"        =>"Gêneros",
                        "roles_ids"    =>"2,3",
                    ]);

            });

        });

    });

    /**
     * Routes System config
     */
    Route::prefix('system')->namespace('system')->name('system.')->group(function (){

        // Grupo de Rotas do Controller "hitsPages"
        Route::name('hits_pages.')->group(function (){

            Route::post('/hits_pages', [ HitsPagesController::class, "index" ])
                ->name('index');

        });

    });
});
