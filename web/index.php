<?php
/** @var \DI\Container $container */

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

require __DIR__ . '/../bootstrap.php';

//load routes
$routes = new RouteCollection();
$finder = new \Symfony\Component\Finder\Finder();
foreach ($finder->in(__DIR__ . '/../routes')->files()->getIterator() as $f) {
    $routeFile = $f->getRealPath();
    if (preg_match('#\.php$#', $routeFile)) {
        $loader = new \Symfony\Component\Routing\Loader\PhpFileLoader(new FileLocator([__DIR__]));
        $routes->addCollection($loader->load($routeFile));
    }
}

$request    = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$context    = new RequestContext();
$matcher    = new UrlMatcher($routes, $context);
$parameters = $matcher->matchRequest($request);

$controller = $parameters['_controller'];
if ($controller instanceof Closure) {
    $response = $controller($parameters);
} else {
    $response = app($controller[0])->{$controller[1]}($parameters);
}
$response->send();