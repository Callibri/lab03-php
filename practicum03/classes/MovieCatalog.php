<?php
declare(strict_types=1);

require_once __DIR__ . '/Movie.php';
require_once __DIR__ . '/RatedMovie.php';

/**
 * Менеджер: зберігає колекцію фільмів (Movie та RatedMovie).
 */
class MovieCatalog
{
    /** @var Movie[] */
    private array $movies = [];

    public function addMovie(Movie $movie): void
    {
        $this->movies[] = $movie;
    }

    /** @return Movie[] */
    public function getAll(): array
    {
        return $this->movies;
    }

    /** Пошук за жанром (без урахування регістру) */
    public function findByGenre(string $genre): array
{
    $pattern = '/^' . preg_quote($genre, '/') . '$/iu';
    return array_values(array_filter(
        $this->movies,
        fn(Movie $m) => preg_match($pattern, $m->getGenre()) === 1
    ));
}
    /** Топ-N фільмів за рейтингом (враховує лише RatedMovie) */
    public function topRated(int $limit = 3): array
    {
        $rated = array_filter($this->movies, fn(Movie $m) => $m instanceof RatedMovie);
        usort($rated, fn(RatedMovie $a, RatedMovie $b) => $b->getRating() <=> $a->getRating());
        return array_slice($rated, 0, $limit);
    }
}
