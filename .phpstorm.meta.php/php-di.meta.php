<?php
/**
 * phpstorm代码提示配置文件
 */

namespace PHPSTORM_META {

    override(
        \DI\Container::get(0),
        map(
            [
                ""       => "@",
                "config" => \Noodlehaus\Config::class,
                "logger" => \Monolog\Logger::class,
                "db"     => \Doctrine\DBAL\Connection::class,
                "twig"     => \Twig_Environment::class,
            ]
        )
    );
    override(
        \app(0),
        map(
            [
                ""       => "@",
                "config" => \Noodlehaus\Config::class,
                "logger" => \Monolog\Logger::class,
                "db"     => \Doctrine\DBAL\Connection::class,
                "twig"     => \Twig_Environment::class,
            ]
        )
    );

}