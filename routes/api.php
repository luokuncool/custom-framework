<?php

use App\Controller\SettingController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('get_setting', new Route('/setting/{key}', ['_controller' => [SettingController::class, 'get']]));
$routes->add('set_setting', new Route('/setting/{key}/{value}', ['_controller' => [SettingController::class, 'set']]));
$routes->add('all_setting', new Route('/setting', ['_controller' => [SettingController::class, 'all']]));

$routes->addPrefix('/api');
return $routes;