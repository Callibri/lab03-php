<?php
declare(strict_types=1);

require_once __DIR__ . '/Movie.php';
require_once __DIR__ . '/../lib/functions.php';

/**
 * Похідний клас: фільм з рейтингом і кількістю рецензій.
 */
class RatedMovie extends Movie
{
    private float $rating;       // від 0 до 10
    private int $reviewsCount;

    public function __construct(
        string $title,
        string $director,
        int $year,
        string $genre,
        float $rating,
        int $reviewsCount
    ) {
        // Спочатку ініціалізуємо успадковану частину об'єкта
        parent::__construct($title, $director, $year, $genre);
        $this->rating       = $rating;
        $this->reviewsCount = $reviewsCount;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getReviewsCount(): int
    {
        return $this->reviewsCount;
    }

    // Перевизначення (override): беремо результат батька й доповнюємо
    public function getInfo(): string
    {
        return parent::getInfo()
            . " | Рейтинг: {$this->rating}/10 " . starsToText($this->rating)
            . ", рецензій: {$this->reviewsCount}";
    }
}
