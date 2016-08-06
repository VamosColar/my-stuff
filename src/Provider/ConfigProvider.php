<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 05/08/16
 * Time: 23:13
 */

namespace MyStuff\Provider;


use MyStuff\Config\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{

    private $name;

    public function __construct($name = 'config')
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {

        $name = $this->name;

        $app['config'] = function ($app) use ($name) {

            return new Config(
                isset($app['dir']) ? $app['dir'] : __DIR__. '/../../'. $name
            );
        };
    }
}