<?php 

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$router = new RouteCollector();

$router->any(
    '/', 
    function () {
        echo '';
    }
);

$router->filter(
    'auth', 
    function () {    
        $filter = new App\Filters\AuthFilter();
        if (!$filter->validate()) {
            return false;
        }
    }
);

$router->group(
    [
        'prefix' => 'api'
    ],
    function ($router) {
        $router->post('/create-account', ['App\Controllers\CreateAccountController', 'create']);
        $router->post('/login', ['App\Controllers\LoginController', 'authenticate']);

        $router->group(
            [
                'before' => 'auth'
            ],
            function ($router) {
                $router->post('/my-movies', ['App\Controllers\ListMyMoviesController', 'index']);
                $router->post('/movies', ['App\Controllers\ListMoviesController', 'index']);
                $router->post('/add-to-favorite', ['App\Controllers\AddToFavoriteController', 'index']);
            }
        );
    }
);

$route = getRequestRoute();
$method = getRequestMethod();

$dispatcher =  new Dispatcher($router->getData());
$dispatcher->dispatch($method, $route, PHP_URL_PATH);
