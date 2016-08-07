<?php declare(strict_types = 1);

namespace MyStuff;

/**
 * Implements Singleton Design Patterns in Application
 *
 * Class ContainerAware
 * @package MyStuff
 */
class ContainerAware{

    private static $app;

    private function __construct(){}

    public static function service($slug)
    {

        if (self::$app === null) {
            self::$app = new Application();
        }

        return self::$app[$slug];
    }
}