<?php
declare(strict_types=1);

/**
 * Базовий клас «Фільм».
 * Властивості мають різні модифікатори доступу (інкапсуляція).
 */
class Movie
{
    private string $title;       // доступна лише всередині Movie
    protected string $director;  // доступна в Movie і нащадках
    protected int $year;
    private string $genre;

    public function __construct(string $title, string $director, int $year, string $genre)
    {
        $this->title    = $title;
        $this->director = $director;
        $this->year     = $year;
        $this->genre    = $genre;
    }

    // Гетери — «контрольований» доступ до private-властивостей
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getInfo(): string
    {
        return "{$this->title} ({$this->year}), реж. {$this->director}, жанр: {$this->genre}";
    }
}
