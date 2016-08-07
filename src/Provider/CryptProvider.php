<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 05/08/16
 * Time: 23:13
 */

namespace MyStuff\Provider;

use MyStuff\Service\Crypt;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CryptProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {

        $app['crypt'] = function ($app) {

            return new Crypt($app);
        };
    }
}