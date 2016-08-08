<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 07/08/16
 * Time: 12:04
 */

namespace MyStuff\Domain\User;


use MyStuff\Domain\Repository\UserRepository;

class User
{

    protected $name = 'indefindo';

    protected $userRepositorio;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepositorio = $userRepository;
    }

    public function save(array $input)
    {

        $this->validateData($input);

        $input['nome'] = $this->getName($input);

        $input['apelido'] = $this->getAlias($input);

        $input['administrador'] = ($input['administrador']) ?? false;

        $this->validateRegister($input['email'], $input['nomeUsuario']);


        return $this->userRepositorio->save($input);
    }

    private function validateData(array $input)
    {
        if (!isset($input['email'])) {
            throw new \InvalidArgumentException('Email é obrigatório');
        }

        if (!isset($input['senha'])) {
            throw new \InvalidArgumentException('A senha é obrigatório');
        }

        if (!isset($input['nomeUsuario'])) {
            throw new \InvalidArgumentException('A senha é obrigatório');
        }
    }

    private function getName(array $input) : string
    {
        return ($input['name']) ?? $this->name;
    }

    private function getAlias(array $input) : string
    {
        if (!isset($input['apelido'])) {

            $pos = strpos($input['email'], '@');

            $input['apelido'] = substr($input['email'], 0, $pos);
        }

        return $input['apelido'];
    }

    private function validateRegister($email, $userName)
    {
        $user = $this->userRepositorio->getQuery()->findOneBy(['email' => $email]);

        if (!is_null($user)) {
            throw new \RuntimeException('Já existe um usuário cadastrado com esse email');
        }

        $userName = $this->userRepositorio
            ->getQuery()->findOneBy(['nomeUsuario' => $userName]);

        if (!is_null($userName)) {
            throw new \RuntimeException('Já existe um usuário cadastrado com esse nome de usuário');
        }
    }



}