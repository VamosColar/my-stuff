<?php

/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 07/08/16
 * Time: 00:13
 */
use MyStuff\Domain\Entitie\User;
use MyStuff\Domain\Repository\UserRepository;


/**
 * Class RepositoryUserTest
 * @group usuarioRepositorio
 */
class RepositoryUserTest extends TestCase
{

    public function testCadastraUsuario()
    {

        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@gmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edy',
            'administrador' => true
        ];

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $user = $usuarioRepositorio->save($input);

        $this->assertEquals($input['email'], $user->getEmail());

        $this->assertTrue(is_string($user->getId()));

        return $user;
    }

    /**
     * @depends testCadastraUsuario
     */
    public function testAtualizacaoDeUsuario($user)
    {
        $id = $user->getId();

        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@hotmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edy',
            'administrador' => false
        ];

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $user2 = $usuarioRepositorio->update($id, $input);

        $this->assertEquals($id, $user2->getId());
    }


    /**
     * @param $user
     * @depends testCadastraUsuario
     */
    public function testBuscaUsuario($user)
    {
        $id = $user->getId();

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $user2 = $usuarioRepositorio->find($id);

        $this->assertEquals($id, $user2->getId());

        return $user2;
    }

    /**
     * @param $user
     * @depends testBuscaUsuario
     */
    public function testRemoveUsuario($user)
    {
        $id = $user->getId();

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $user2 = $usuarioRepositorio->remove($id);

        $this->assertTrue($user2);
    }

    /**
     * @expectedException MyStuff\Exception\UserNotFoundException
     */
    public function testBuscaUsuarioQueNaoExiste()
    {
        $id = '8989hgtgd';

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $usuarioRepositorio->find($id);

    }

    /**
     * @expectedException MyStuff\Exception\UserNotFoundException
     */
    public function testRemoveUsuarioQueNaoExiste()
    {
        $id = '8989hgtgd';

        $usuario = new User();

        $usuarioRepositorio = new UserRepository($usuario);

        $usuarioRepositorio->remove($id);
    }

}
