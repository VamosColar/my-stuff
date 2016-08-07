<?php

/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 06/08/16
 * Time: 21:52
 */

/**
 * Class CriptTest
 * @group cript
 */
use MyStuff\Service\Crypt as Cript;

class CryptTest extends TestCase
{


    public function testRetornaUmaStringSimples()
    {

        $senha = '123456789';

        $cript = new Cript(new \MyStuff\Application());

        $senhaHash = $cript->hash($senha);

        $this->assertTrue(is_string($senhaHash));

    }

    public function testRetornaUmaStringDeHashCom60Caracteres()
    {

        $senha = '123456789';

        $cript = new Cript(new \MyStuff\Application());

        $senhaHash = $cript->hash($senha);

        $this->assertEquals(60, strlen($senhaHash));

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testVerificaSeStringPassadaEVazia()
    {

        $cript = new Cript(new \MyStuff\Application());

        $cript->hash("");

    }

    public function testCheckaSeDoisHashSaoIguais()
    {

        $senha = '123456789';

        $cript = new Cript(new \MyStuff\Application());

        $senhaHash = $cript->hash($senha);

        $this->assertTrue($cript->check($senha, $senhaHash));

    }

}
