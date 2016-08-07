<?php

/**
 * Class ProviderTest
 * @group provider
 */

use MyStuff\Service\Config;

class ProviderTest extends TestCase
{

    private $app;

    public function setUp()
    {
        $this->app = new \MyStuff\Application();
        parent::setUp();
    }

    public function testVerificaObjetosIguaisTantoDoProviderQuandoInstanciado()
    {

        $config = new Config(__DIR__);

        $configApp = $this->app['config'];

        $this->assertInstanceOf(get_class($config), $configApp);

    }

    public function testRetorneValorDeCaminhoPublicUsandoProvider()
    {
        $configApp = \MyStuff\ContainerAware::service('config');

        $this->assertTrue(is_array($configApp->get('app')));
    }

}