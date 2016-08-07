<?php

/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 06/08/16
 * Time: 23:54
 */
use \MyStuff\Application;
use \MyStuff\Service\Crypt;

/**
 * Class CryptTest
 * @group provider
 */
class CryptProviderTest extends TestCase
{

    public function testVerificaSeObjetoCryptIgualAoObjetoDoProviderCrupt()
    {

        $app = new Application();

        $crypt = $app['crypt'];

        $classCrypt = new Crypt($app);

        $this->assertInstanceOf(get_class($classCrypt), $crypt);

    }
}
