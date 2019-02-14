<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('home', new Route("/", ['_controller' => [\App\Controller\WelcomeController::class, 'home']]));
return $routes;