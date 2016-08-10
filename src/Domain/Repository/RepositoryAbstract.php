<?php declare(strict_types = 1);

namespace MyStuff\Domain\Repository;

use MyStuff\Application;
use MyStuff\Domain\Entitie\EntityInterface;

abstract class RepositoryAbstract
{

    protected $connection;

    protected $entitie;

    public function __construct(EntityInterface $entitie)
    {
        $app = new Application();

        $this->connection = $app['db'];

        $this->entitie = $entitie;

    }

    public function persist(EntityInterface $entitieInterface)
    {
        $this->connection->persist($entitieInterface);

    }

    public function flush()
    {
        $this->connection->flush();

        return $this->entitie;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}