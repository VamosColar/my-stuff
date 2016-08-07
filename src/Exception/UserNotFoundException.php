<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 07/08/16
 * Time: 01:09
 */

namespace MyStuff\Exception;


class UserNotFoundException extends \RuntimeException
{
    public function __construct($message = 'Usuário não encontrado')
    {
        parent::__construct($message);
    }
}