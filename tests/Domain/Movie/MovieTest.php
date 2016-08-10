<?php
declare(strict_types = 1);

use MyStuff\Domain\Movie\Movie;
use MyStuff\Domain\Repository\MovieRepository;
use MyStuff\Domain\Entitie\MovieEntity;

class MovieTest extends TestCase
{
    /**
     * @group MyStuff
     * @group MyStuffMovie
     * @group MyStuffMovieSave
     */
    public function testCadastrarFilme()
    {
        $input = [
            'titulo' => 'Os Oito Odiados',
            'tituloOriginal' => 'The Hateful Eight',
            'sinopse' => 'In the dead of a Wyoming winter, a bounty hunter and his prisioner find shelter in a cabin currently inhabited by a collection of nefarious characters.',
            'capa' => 'the-hateful-eight.jpg',
            'genero' => [
                'Crime',
                'Drama',
                'Mistery'
            ],
            'elenco' => [
                [
                    'nome' => 'Samuel L. Jackson',
                    'personagem' => 'Major Marquis Warren'
                ],
                [
                    'nome' => 'Kurt Russell',
                    'personagem' => 'John Ruth'
                ],
                [
                    'nome' => 'Jennifer Jason Leigh',
                    'personagem' => 'Daisy Domergue'
                ],
                [
                    'nome' => 'Walton Goggins',
                    'personagem' => 'Sheriff Chris Mannix'
                ],
                [
                    'nome' => 'Demián Bichir',
                    'personagem' => 'Bob, as Demian Bichir'
                ],
                [
                    'nome' => 'Tim Roth',
                    'personagem' => 'Oswaldo Mobray'
                ],
                [
                    'nome' => 'Michael Madsen',
                    'personagem' => 'Joe Gage'
                ],
                [
                    'nome' => 'Bruce Dern',
                    'personagem' => 'General Sandy Smithers'
                ],
                [
                    'nome' => 'James Parks',
                    'personagem' => 'O.B.'
                ],
                [
                    'nome' => 'Dana Gourrier',
                    'personagem' => 'Minnie Mink'
                ],
                [
                    'nome' => 'Zoë Bell',
                    'personagem' => 'Six-Horse Judy'
                ]
            ],
            'diretor' => [
                [
                    'nome' => 'Quentin Tarantino'
                ]
            ],
            'ano' => 2015,
            'duracao' => '03:07:00',
            'dono' =>
                ['Alex Gomes']
        ];

        $entidade = new MovieEntity();
        $repositorio = new MovieRepository($entidade);
        $negocio = new Movie($repositorio);
        $filme = $negocio->save($input);

        $this->assertInstanceOf(MovieEntity::class, $filme);

        return $filme;
    }

    /**
     * @group MyStuff
     * @group MyStuffMovie
     * @group MyStuffMovieGetById
     * @depends testCadastrarFilme
     */
    public function testObterFilmePeloId($movie)
    {
        $entidade = new MovieEntity();
        $repositorio = new MovieRepository($entidade);
        $negocio = new Movie($repositorio);

        $filme = $negocio->find($movie->getId());

        $this->assertInstanceOf(stdClass::class, $filme);
    }

    /**
     * @group MyStuff
     * @group MyStuffMovie
     * @group MyStuffMovieUpdate
     * @depends testCadastrarFilme
     */
    public function testAtualizarFilme($movie)
    {
        $input = [
            'titulo' => 'Os Oito Odiados',
            'tituloOriginal' => 'The Hateful Eight',
            'sinopse' => 'In the dead of a Wyoming winter, a bounty hunter and his prisioner find shelter in a cabin currently inhabited by a collection of nefarious characters.',
            'capa' => 'the-hateful-eight.jpg',
            'genero' => [
                'Crime',
                'Drama'
            ],
            'elenco' => [
                [
                    'nome' => 'Samuel L. Jackson',
                    'personagem' => 'Major Marquis Warren'
                ],
                [
                    'nome' => 'Kurt Russell',
                    'personagem' => 'John Ruth'
                ],
                [
                    'nome' => 'Jennifer Jason Leigh',
                    'personagem' => 'Daisy Domergue'
                ]
            ],
            'diretor' => [
                [
                    'nome' => 'Quentin Tarantino'
                ]
            ],
            'ano' => 2015,
            'duracao' => '03:07:00',
            'dono' =>
                ['Alex Gomes']
        ];

        $entidade = new MovieEntity();
        $repositorio = new MovieRepository($entidade);
        $negocio = new Movie($repositorio);

        $filme = $negocio->update($movie->getId(), $input);

        $this->assertInstanceOf(MovieEntity::class, $filme);
    }

    /**
     * @group MyStuff
     * @group MyStuffMovie
     * @group MyStuffMovieDelete
     * @depends testCadastrarFilme
     */
    public function testRemoverFilme($movie)
    {
        $entidade = new MovieEntity();
        $repositorio = new MovieRepository($entidade);
        $negocio = new Movie($repositorio);

        $excluir = $negocio->delete($movie->getId());

        $this->assertTrue($excluir);
    }

    /**
     * @group MyStuff
     * @group MyStuffMovie
     * @group MyStuffMovieAll
     * @depends testCadastrarFilme
     */
    public function testObterFilmePeloTitulo($movie)
    {
        $entidade = new MovieEntity();
        $repositorio = new MovieRepository($entidade);
        $negocio = new Movie($repositorio);
        $filme = $negocio->getMovieByTitle($movie->getTitulo());

        $this->assertInstanceOf(\stdClass::class, $filme);
    }
}
