<?php
declare(strict_types = 1);

namespace MyStuff\Domain\System\Business;

/**
 * Interface CrudInterface
 *
 * @package MyStuff\Domain\System\Business
 */
interface CrudInterface
{
    public function find(string $id);

    public function save(array $input);

    public function update(string $id, array $input);

    public function delete(string $id);
}
