<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Entitie;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="media") */
class MovieEntity extends MediaEntity
{
    /** @ODM\Field(type="string") */
    private $duracao;

    /** @ODM\ReferenceMany(targetDocument="ActorEntity", cascade="all") */
    private $elenco = [];

    /** @ODM\ReferenceMany(targetDocument="DirectorEntity", cascade="all") */
    private $diretor = [];

    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param $duracao
     * @return $this
     */
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getElenco()
    {
        return $this->elenco;
    }

    /**
     * @param $ator
     * @return $this
     */
    public function setElenco($ator)
    {
        $this->elenco = $ator;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiretor()
    {
        return $this->diretor;
    }

    /**
     * @param $diretor
     * @return $this
     */
    public function setDiretor($diretor)
    {
        $this->diretor = $diretor;

        return $this;
    }
}
