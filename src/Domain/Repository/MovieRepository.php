<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Repository;

use MyStuff\Domain\Entitie\MovieEntity;

/**
 * Class MovieRepository
 *
 * @package MyStuff\Domain\Repository
 */
class MovieRepository extends RepositoryAbstract
{
    /**
     * @var MovieEntity
     */
    private $movie;

    /**
     * MovieRepository constructor.
     * @param MovieEntity $entity
     */
    public function __construct(MovieEntity $entity)
    {
        $this->movie = $entity;

        parent::__construct($entity);
    }

    /**
     * @param array $input
     * @return MovieEntity
     */
    public function save(array $input)
    {
        $this->movie
            ->setAno($input['ano'])
            ->setCapa($input['capa'])
            ->setTitulo($input['titulo'])
            ->setTituloOriginal($input['tituloOriginal'])
            ->setDono($input['dono'])
            ->setDuracao($input['duracao'])
            ->setSinopse($input['sinopse']);

        $this->persist($this->movie);

        // Gênero
        $this->movie->setGenero($input['genero']);

        // Elenco
        $this->movie->setElenco($input['elenco']);

        // Diretor
        $this->movie->setDiretor($input['diretor']);

        $this->flush();

        return $this->movie;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function find(string $id)
    {
        return $this->getConnection()->find(get_class($this->movie), $id);
    }

    /**
     * @param string $id
     * @param array $input
     * @return mixed|MovieEntity
     */
    public function update(string $id, array $input)
    {
        $this->movie = $this->find($id);

        $this->movie
            ->setAno($input['ano'])
            ->setCapa($input['capa'])
            ->setTitulo($input['titulo'])
            ->setTituloOriginal($input['tituloOriginal'])
            ->setDono($input['dono'])
            ->setDuracao($input['duracao'])
            ->setSinopse($input['sinopse']);

        $this->persist($this->movie);

        // Gênero
        $this->movie->setGenero($input['genero']);

        // Elenco
        $this->movie->setElenco($input['elenco']);

        // Diretor
        $this->movie->setDiretor($input['diretor']);

        $this->flush();

        return $this->movie;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function remove(string $id)
    {
        $movie = $this->find($id);

        $this->getConnection()->remove($movie);

        $this->flush();

        return true;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->getConnection()->getRepository(get_class($this->movie));
    }
}
