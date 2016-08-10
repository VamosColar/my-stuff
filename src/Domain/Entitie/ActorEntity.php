<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Entitie;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="cast") */
class ActorEntity extends CastEntity
{
    /** @ODM\Field(type="string") */
    private $personagem;

    /**
     * @return mixed
     */
    public function getPersonagem()
    {
        return $this->personagem;
    }

    /**
     * @param $personagem
     * @return $this
     */
    public function setPersonagem($personagem)
    {
        $this->personagem = $personagem;

        return $this;
    }
}
