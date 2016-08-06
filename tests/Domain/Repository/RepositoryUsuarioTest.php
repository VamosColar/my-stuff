<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 03/08/16
 * Time: 14:05
 */

class RepositoryUsuarioTest extends \PHPUnit_Framework_TestCase
{

    public function testCadatroDeUsuarioComRepository()
    {

        $usuario = new \MyStuff\Domain\Entitie\Usuario();

        $repositorio = new \MyStuff\Domain\Repository\Usuario\RepositoryUsuario($usuario);

        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@gmail.com',
            'nomeUsuario' => 'edyonil',
            'senha' => '123456SD',
            'apelido' => 'edyonil'
        ];

        $repositorio->save($input);
        $repositorio->persist();
        $objeto = $repositorio->flush();

        $this->assertEquals($input['nome'], $objeto->getNome());


    }

}
