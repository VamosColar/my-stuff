<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Movie;

/**
 * Interface MovieInterface
 *
 * @package MyStuff\Domain\Movie
 */
interface MovieInterface
{
    public function getMovieByTitle(string $title);

    public function getMovieByYear(int $year);

    public function getMovieByOwner(string $owner);

    public function getMovieByActor(string $actor);

    public function getMovieByDirector(string $director);

    public function getMovieByGenre(string $genre);
}
