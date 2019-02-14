<?php

namespace App;

use DI\Container;

class Context
{
    /**
     * @var Container
     */
    private static $container;

    public static function setContainer(Container $container)
    {
        self::$container = $container;
    }

    public static function getContainer()
    {
        return self::$container;
    }

    public function get($name)
    {
        return self::getContainer()->get($name);
    }
}