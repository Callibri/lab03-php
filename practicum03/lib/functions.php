<?php
declare(strict_types=1);

/** 142 хв -> "2 год 22 хв" */
function formatRuntime(int $minutes): string
{
    $h = intdiv($minutes, 60);
    $m = $minutes % 60;
    return $h > 0 ? "{$h} год {$m} хв" : "{$m} хв";
}

/** Рейтинг 0–10 -> текстові зірки з 5 (напр. 8.6 -> "★★★★☆") */
function starsToText(float $rating): string
{
    $stars = (int) round(max(0, min(10, $rating)) / 2);
    return str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
}
