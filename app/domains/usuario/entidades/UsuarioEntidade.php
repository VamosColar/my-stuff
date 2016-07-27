<?php
namespace app\domains\usuario\entidades;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document  */
class UsuarioEntidade
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
