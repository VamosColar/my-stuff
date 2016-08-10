<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Entitie;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="media") */
abstract class MediaEntity implements EntitieInterface
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $titulo;

    /** @ODM\Field(type="string", name="titulo_original") */
    private $tituloOriginal;

    /** @ODM\Field(type="string") */
    private $sinopse;

    /** @ODM\Field(type="string") */
    private $capa;

    /** @ODM\ReferenceMany(targetDocument="GenreEntity", cascade="all") */
    private $genero = [];

    /** @ODM\Field(type="integer") */
    private $ano;

    /** @ODM\Field(type="string") */
    private $dono;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param $titulo
     * @return $this
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTituloOriginal()
    {
        return $this->tituloOriginal;
    }

    /**
     * @param $tituloOriginal
     * @return $this
     */
    public function setTituloOriginal($tituloOriginal)
    {
        $this->tituloOriginal = $tituloOriginal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSinopse()
    {
        return $this->sinopse;
    }

    /**
     * @param $sinopse
     * @return $this
     */
    public function setSinopse($sinopse)
    {
        $this->sinopse = $sinopse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapa()
    {
        return $this->capa;
    }

    /**
     * @param $capa
     * @return $this
     */
    public function setCapa($capa)
    {
        $this->capa = $capa;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param $genero
     * @return $this
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @param $ano
     * @return $this
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDono()
    {
        return $this->dono;
    }

    /**
     * @param $dono
     * @return $this
     */
    public function setDono($dono)
    {
        $this->dono = $dono;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function add();

    /**
     * @return mixed
     */
    public abstract function remove();

    /**
     * @return mixed
     */
    public abstract function update();

    /**
     * @return mixed
     */
    public abstract function list();
}
