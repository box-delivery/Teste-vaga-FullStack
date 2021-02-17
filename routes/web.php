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

$router->group([
        'prefix' => 'api'
    ],
    function ($router){
        $router->post('/create-account', ['App\Controllers\CreateAccountController', 'create']);
        $router->post('/login', ['App\Controllers\LoginController', 'authenticate']);
    }
);

$route = getRequestRoute();
$method = getRequestMethod();

$dispatcher =  new Dispatcher($router->getData());
$dispatcher->dispatch($method, $route, PHP_URL_PATH);

