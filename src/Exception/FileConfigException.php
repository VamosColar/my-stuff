<?php
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 05/08/16
 * Time: 20:32
 */

namespace MyStuff\Exception;


class FileConfigException extends \Exception
{

    public function __construct($message = null)
    {
        $newMessage = $message ? $message : 'Arquivo de configuração não encontrado no diretório especificado';

        parent::__construct($newMessage);
    }

}