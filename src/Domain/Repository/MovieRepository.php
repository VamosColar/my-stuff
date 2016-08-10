<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Repository;

use MyStuff\Domain\Entitie\CastEntity;
use MyStuff\Domain\Entitie\GenreEntity;
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
     * @param MovieEntity $entitie
     */
    public function __construct(MovieEntity $entitie)
    {
        $this->movie = $entitie;

        parent::__construct($entitie);
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
        $generos = [];

        foreach ($input['genero'] as $g) {
            $genero = new GenreEntity();
            $genero->setDescricao($g);

            $generos[] = $genero;
        }

        $this->movie->setGenero($generos);

        // Elenco
        $elenco = [];

        foreach ($input['atores'] as $a) {
            $ator = new CastEntity();
            $ator->setNome($a);

            $elenco[] = $ator;
        }

        $this->movie->setElenco($elenco);

        // Diretor
        $diretor = new CastEntity();
        $diretor->setNome($input['diretor']);

        $this->movie->setDiretor([$diretor]);

        $this->flush();

        return $this->movie;
    }
}
