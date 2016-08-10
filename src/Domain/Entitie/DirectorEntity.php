<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Entitie;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="cast") */
class DirectorEntity extends CastEntity
{
    //
}
