<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Movie;

use MyStuff\Domain\Entitie\ActorEntity;
use MyStuff\Domain\Entitie\DirectorEntity;
use MyStuff\Domain\Entitie\GenreEntity;
use MyStuff\Domain\Entitie\MovieEntity;
use MyStuff\Domain\Entitie\User;
use MyStuff\Domain\Repository\MovieRepository;
use MyStuff\Domain\System\Business\CrudInterface;

/**
 * Class Movie
 *
 * @package MyStuff\Domain\Movie
 */
class Movie implements CrudInterface, MovieInterface
{
    /**
     * @var MovieRepository
     */
    protected $rMovie;

    /**
     * Movie constructor.
     *
     * @param MovieRepository $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->rMovie = $movieRepository;
    }

    /**
     * @param array $input
     * @return \MyStuff\Domain\Entitie\MovieEntity
     */
    public function save(array $input)
    {
        $this->validateInput($input);

        $data = [
            'titulo' => $input['titulo'],
            'tituloOriginal' => $input['tituloOriginal'],
            'sinopse' => $input['sinopse'],
            'capa' => $input['capa'],
            'ano' => $input['ano'],
            'duracao' => $input['duracao']
        ];

        $data['genero'] = $this->prepareGenre($input['genero']);
        $data['elenco'] = $this->prepareCast($input['elenco']);
        $data['diretor'] = $this->prepareDirector($input['diretor']);
        $data['dono'] = $this->prepareOwner($input['dono']);

        return $this->rMovie->save($data);
    }

    /**
     * @param array $input
     * @throws \Exception
     */
    protected function validateInput(array $input)
    {
        if (!isset($input['titulo'])) {
            throw new \Exception('Título é obrigatório.');
        }

        if (!isset($input['tituloOriginal'])) {
            throw new \Exception('Título Original é obrigatório.');
        }

        if (!isset($input['sinopse'])) {
            throw new \Exception('Sinopse é obrigatório.');
        }

        if (!isset($input['capa'])) {
            throw new \Exception('Capa é obrigatório.');
        }

        if (!isset($input['ano'])) {
            throw new \Exception('Ano é obrigatório.');
        }

        if (!isset($input['duracao'])) {
            throw new \Exception('Duração é obrigatório.');
        }

        if (!isset($input['genero'])) {
            throw new \Exception('Gênero é obrigatório.');
        }

        if (!is_array($input['genero'])) {
            throw new \Exception('Deve ser informado um array genero.');
        }

        if (!isset($input['elenco'])) {
            throw new \Exception('Elenco é obrigatório.');
        }

        if (!is_array($input['elenco'])) {
            throw new \Exception('Deve ser informado um array elenco.');
        }

        if (!isset($input['diretor'])) {
            throw new \Exception('Diretor é obrigatório.');
        }

        if (!is_array($input['diretor'])) {
            throw new \Exception('Deve ser informado um array diretor.');
        }
    }

    /**
     * @param array $genre
     * @return array
     */
    protected function prepareGenre(array $genre)
    {
        $items = [];

        foreach ($genre as $g) {
            $item = new GenreEntity();
            $item->setDescricao($g);

            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param array $cast
     * @return array
     */
    protected function prepareCast(array $cast)
    {
        $items = [];

        foreach ($cast as $c) {
            $item = new ActorEntity();
            $item->setNome($c['nome'])
                ->setPersonagem($c['personagem']);

            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param array $director
     * @return array
     */
    protected function prepareDirector(array $director)
    {
        $items = [];

        foreach ($director as $d) {
            $item = new DirectorEntity();
            $item->setNome($d['nome']);

            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param array $owner
     * @return array
     */
    protected function prepareOwner(array $owner)
    {
        $items = [];

        foreach ($owner as $o) {
            $item = new User();
            $item->setNome($o);

            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param string $id
     * @return \stdClass
     * @throws \Exception
     */
    public function find(string $id)
    {
        $movie = $this->rMovie->find($id);

        if (is_null($movie)) {
            throw new \Exception('Dados do filme não encontrados.');
        }

        return $this->prepareOutput($movie);
    }

    /**
     * Trata os dados do filme
     *
     * @param MovieEntity $movie
     * @return \stdClass
     */
    protected function prepareOutput(MovieEntity $movie)
    {
        $data = new \stdClass();
        $data->id = $movie->getId();
        $data->titulo = $movie->getTitulo();
        $data->tituloOriginal = $movie->getTituloOriginal();
        $data->sinopse = $movie->getSinopse();
        $data->capa = $movie->getCapa();
        $data->ano = $movie->getAno();
        $data->duracao = $movie->getDuracao();
        $data->genero = [];
        $data->elenco = [];
        $data->diretor = [];
        $data->dono = new \stdClass();
        $data->dono->id = $movie->getDono()[0]->getId();
        $data->dono->nome = $movie->getDono()[0]->getNome();

        // Genre
        $genre = $movie->getGenero();

        foreach ($genre as $g) {
            $data->genero[] = $g->getDescricao();
        }

        // Cast
        $cast = $movie->getElenco();

        foreach ($cast as $c) {
            $item = new \stdClass();
            $item->nome = $c->getNome();
            $item->personagem = $c->getPersonagem();

            $data->elenco[] = $item;
        }

        // Director
        $director = $movie->getDiretor();

        foreach ($director as $d) {
            $item = new \stdClass();
            $item->nome = $d->getNome();

            $data->diretor[] = $item;
        }

        return $data;
    }

    /**
     * @param string $id
     * @param array $input
     * @return mixed|\MyStuff\Domain\Entitie\MovieEntity
     * @throws \Exception
     */
    public function update(string $id, array $input)
    {
        $movie = $this->rMovie->find($id);

        if (is_null($movie)) {
            throw new \Exception('Dados do filme não encontrados.');
        }

        $this->validateInput($input);

        $data = [
            'titulo' => $input['titulo'],
            'tituloOriginal' => $input['tituloOriginal'],
            'sinopse' => $input['sinopse'],
            'capa' => $input['capa'],
            'ano' => $input['ano'],
            'duracao' => $input['duracao']
        ];

        $data['genero'] = $this->prepareGenre($input['genero']);
        $data['elenco'] = $this->prepareCast($input['elenco']);
        $data['diretor'] = $this->prepareDirector($input['diretor']);
        $data['dono'] = $this->prepareOwner($input['dono']);

        return $this->rMovie->update($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     * @throws \Exception
     */
    public function delete(string $id)
    {
        $movie = $this->rMovie->find($id);

        if (is_null($movie)) {
            throw new \Exception('Dados do filme não encontrados.');
        }

        return $this->rMovie->remove($id);
    }

    public function getMovieByTitle(string $title)
    {
        //
    }

    public function getMovieByYear(int $year)
    {
        // TODO: Implement getMovieByYear() method.
    }

    public function getMovieByOwner(string $owner)
    {
        // TODO: Implement getMovieByOwner() method.
    }

    public function getMovieByActor(string $actor)
    {
        // TODO: Implement getMovieByActor() method.
    }

    public function getMovieByDirector(string $director)
    {
        // TODO: Implement getMovieByDirector() method.
    }

    public function getMovieByGenre(string $genre)
    {
        // TODO: Implement getMovieByGenre() method.
    }
}
