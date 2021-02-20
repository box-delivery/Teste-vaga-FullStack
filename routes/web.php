<?php 

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$router = new RouteCollector();

$router->any('/', function(){
    echo 'Olá mundo';
});

$router->get('/example', function(){
    echo 'This route responds to requests with the GET method at the path /example';
});

$router->filter('auth', function(){    
    $filter = new App\Filters\AuthFilter();
    return $filter->validate();
});

$router->group([
        'prefix' => 'api'
    ],
    function ($router){
        $router->post('/create-account', ['App\Controllers\CreateAccountController', 'create']);
        $router->post('/login', ['App\Controllers\LoginController', 'authenticate']);

        $router->group([
            'before' => 'auth'
        ],
        function ($router){
            $router->post('/my-movies', ['App\Controllers\ListMyMoviesController', 'index']);
        }
    );
    }
);

$route = getRequestRoute();
$method = getRequestMethod();

$dispatcher =  new Dispatcher($router->getData());
$dispatcher->dispatch($method, $route, PHP_URL_PATH);

