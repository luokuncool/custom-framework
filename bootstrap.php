<?php

use App\Context;
use App\Noodlehaus\Config;
use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$loader = require __DIR__ . '/vendor/autoload.php';
\Symfony\Component\Debug\Debug::enable(E_ALL ^ E_WARNING ^ E_NOTICE);
AnnotationRegistry::registerLoader(array($loader, "loadClass"));

$builder = new ContainerBuilder();
$builder->useAnnotations(true);
$builder->addDefinitions([
    'config' => function (\DI\Container $c) {
        $files  = [];
        $finder = new \Symfony\Component\Finder\Finder();
        foreach ($finder->in(__DIR__ . '/config')->files()->getIterator() as $f) {
            $files[] = $f->getRealPath();
        }
        $config = new Config($files);
        $config->set('system.root', __DIR__);
        return $config;
    },
    'logger' => function (\DI\Container $c) {
        $logger = new \Monolog\Logger('app');
        $config = $c->get('config');
        $logger->pushHandler(new StreamHandler("{$config['logdir']}/" . date('Y/m/d') . '.log', Logger::DEBUG));
        return $logger;
    },
    'db'     => function (\DI\Container $c) {
        $config           = $c->get('config');
        $connectionParams = ['url' => $config['db.url']];

        $configuration = new Configuration();
        $configuration->setSQLLogger($c->get(\App\Doctrine\DBAL\Logging\QueryFileLogger::class));

        return DriverManager::getConnection($connectionParams, $configuration);
    },
    'twig'   => function (\DI\Container $c) {
        $config = $c->get('config');

        $loader = new Twig_Loader_Filesystem($config['twig.views']);
        $twig   = new Twig_Environment($loader, array(
            'debug' => true,
            'cache' => $config['twig.cache'],
        ));
        return $twig;
    }
]);
$container = $builder->build();
Context::setContainer($container);

return $container;