<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/cadastro', ['controller' => 'Users', 'action' => 'register']);
    $routes->connect('/consulta-ia', ['controller' => 'Ai', 'action' => 'consult']);
    $routes->connect('/reservas', ['controller' => 'Reservations', 'action' => 'index']);

    $routes->fallbacks(DashedRoute::class);
});
