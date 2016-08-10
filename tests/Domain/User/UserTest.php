<?php

/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 07/08/16
 * Time: 11:52
 */
use MyStuff\Domain\User\User;
use MyStuff\Domain\Entitie\User as UserEntities;
use MyStuff\Domain\Repository\UserRepository;

/**
 * Class UserTest
 * @group UserBusiness
 */
class UserTest extends TestCase
{

    private $userBussines;

    private $repositorio;

    public function __construct()
    {
        parent::__construct();

        $user = new UserEntities();

        $this->repositorio = new UserRepository($user);

        $this->userBussines = new User($this->repositorio);
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->repositorio->getConnection()
             ->createQueryBuilder('MyStuff\Domain\Entitie\User')
             ->field('email')->equals('edyonil@gmail.com')
             ->remove()
             ->getQuery()
             ->execute();
    }

    public function testCriacaoDeUsuarioComACamadaDeNegocio()
    {
        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@gmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edy',
            'administrador' => true
        ];

        $userRepositorio = $this->userBussines->save($input);

        $this->assertInstanceOf(get_class($userRepositorio), new UserEntities());

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testVerificaSeOUsuarioPossuirEmailSenhaUserNameDefinido()
    {
        $input = [
            'nome' => 'Ediaimo Borges',
            'apelido' => 'edy',
            'administrador' => true
        ];

        $userRepositorio = $this->userBussines->save($input);

        $this->assertInstanceOf(get_class($userRepositorio), new UserEntities());

    }

    public function testCadastraUsuarioMesmoNaoPossuindoNomeApelidoAdminstrador()
    {
        $input = [
            'email' => 'edyonil@gmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
        ];

        $userRepositorio = $this->userBussines->save($input);

        $esperadoNome = 'indefindo';
        $esperadoApelido = 'edyonil';

        $this->assertEquals($esperadoNome, $userRepositorio->getNome());
        $this->assertEquals($esperadoApelido, $userRepositorio->getApelido());
        $this->assertFalse($userRepositorio->getAdministrador());

    }

    /**
     * @expectedException \RuntimeException
     */
    public function testVerificaSeJaExisteUmUsuarioCadastroComEsseEmailERetornaExcessao()
    {
        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@gmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edy',
            'administrador' => true
        ];

        $this->userBussines->save($input);

        $input = [
            'nome' => 'Edy Borges',
            'email' => 'edyonil@gmail.com',
            'senha' => '123456789',
            'nomeUsuario' => 'edyosnil',
            'apelido' => 'edys',
            'administrador' => false
        ];

        $this->userBussines->save($input);
    }


    /**
     * @expectedException \RuntimeException
     * @group verifica
     */
    public function testVerificaSeJaExisteUmUsuarioCadastroComEsseEmailOuNomeUsuarioRetornaExcessao()
    {
        $input = [
            'nome' => 'Ediaimo Borges',
            'email' => 'edyonil@gmail.com',
            'senha' => '12345678',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edy',
            'administrador' => true
        ];

        $this->userBussines->save($input);

        $input = [
            'nome' => 'Edy Borges',
            'email' => 'edyonil@gmaisl.com',
            'senha' => '123456789',
            'nomeUsuario' => 'edyonil',
            'apelido' => 'edys',
            'administrador' => false
        ];

        $this->userBussines->save($input);
    }

}
