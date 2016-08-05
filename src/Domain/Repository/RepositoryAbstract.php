<?php declare(strict_types = 1);

namespace MyStuff\Domain\Repository;

use MyStuff\Application;
use MyStuff\Domain\Entitie\EntitieInterface;

abstract class RepositoryAbstract
{

    protected $connection;

    protected $entitie;

    public function __construct(EntitieInterface $entitie)
    {
        $app = new Application();

        $this->connection = $app['db'];

        $this->entitie = $entitie;

    }

    public function persist()
    {
        $this->connection->persist($this->entitie);

    }

    public function flush()
    {
        $this->connection->flush();

        return $this->entitie;
    }

}