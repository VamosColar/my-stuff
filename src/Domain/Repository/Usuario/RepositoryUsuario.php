<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 03/08/16
 * Time: 13:44
 */

namespace MyStuff\Domain\Repository\Usuario;

use MyStuff\Domain\Entitie\Usuario;
use MyStuff\Domain\Repository\RepositoryAbstract;

class RepositoryUsuario extends RepositoryAbstract
{

    /**
     * @var Usuario
     */
    private $usuario;

    /**
     * RepositoryUsuario constructor.
     * @param Usuario $usuario
     */
    public function __construct(Usuario $usuario)
    {
        parent::__construct($usuario);

        $this->usuario = $usuario;
    }

    public function save(array $input)
    {
        $this->usuario
             ->setNome($input['nome'])
             ->setEmail($input['email'])
             ->setNomeUsuario($input['nomeUsuario'])
             ->setApelido($input['apelido'])
             ->setSenha($input['senha']);

        $this->persist();
        $this->flush();

        return $this->usuario;
    }


}