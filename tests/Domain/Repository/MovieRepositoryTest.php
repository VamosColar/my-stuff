<?php
declare(strict_types = 1);

use MyStuff\Domain\Entitie\MovieEntity;
use MyStuff\Domain\Repository\MovieRepository;

/**
 * Class MediaRepositoryTest
 */
class MovieRepositoryTest extends TestCase
{
    /**
     * @group Movie
     * @group MovieSalvar
     */
    public function testCadastrarFilme()
    {
        $this->markTestSkipped();

        $input = [
            'titulo' => 'Os Oito Odiados',
            'tituloOriginal' => 'The Hateful Eight',
            'sinopse' => 'In the dead of a Wyoming winter, a bounty hunter and his prisioner find shelter in a cabin currently inhabited by a collection of nefarious characters.',
            'capa' => 'the-hateful-eight.jpg',
            'genero' => [
                'crime',
                'drama',
                'mistery'
            ],
            'elenco' => [
                'Samuel L. Jackson',
                'Kurt Russell',
                'Jennifer Jason Leigh',
                'Walton Goggins',
                'Demián Bichir',
                'Tim Roth',
                'Michael Madsen',
                'Bruce Dern',
                'James Parks',
                'Dana Gourrier',
                'Zoë Bell',
                'Gene Jones'
            ],
            'diretor' => [
                'Quentin Tarantino'
            ],
            'ano' => 2015,
            'duracao' => '03:07:00',
            'dono' => 'Alex Gomes'
        ];

        $entiadade = new MovieEntity();
        $repositorio = new MovieRepository($entiadade);
        $repositorio->save($input);

        $this->assertInternalType('string', $entiadade->getId());
    }
}
