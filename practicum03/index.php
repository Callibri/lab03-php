<?php
declare(strict_types=1);

require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/classes/Movie.php';
require_once __DIR__ . '/classes/RatedMovie.php';
require_once __DIR__ . '/classes/MovieCatalog.php';

$catalog = new MovieCatalog();

// Об'єкти базового класу
$catalog->addMovie(new Movie('Тіні забутих предків', 'Сергій Параджанов', 1965, 'Драма'));
$catalog->addMovie(new Movie('Земля', 'Олександр Довженко', 1930, 'Драма'));

// Об'єкти похідного класу
$catalog->addMovie(new RatedMovie('Початок', 'Крістофер Нолан', 2010, 'Фантастика', 8.8, 2400));
$catalog->addMovie(new RatedMovie('Матриця', 'Вачовскі', 1999, 'Фантастика', 8.7, 1900));
$catalog->addMovie(new RatedMovie('Паразити', 'Пон Джун-хо', 2019, 'Трилер', 8.5, 1500));

$runtimes = ['Тіні забутих предків' => 97, 'Початок' => 148, 'Матриця' => 136];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кінотека</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; margin-bottom: 2rem; }
        th, td { border: 1px solid #999; padding: 6px 10px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
<h1>Кінотека</h1>

<h2>Усі фільми</h2>
<table>
    <tr><th>#</th><th>Тип</th><th>Інформація</th><th>Тривалість</th></tr>
    <?php foreach ($catalog->getAll() as $i => $movie): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($movie::class) ?></td>
            <td><?= htmlspecialchars($movie->getInfo()) ?></td>
            <td><?= isset($runtimes[$movie->getTitle()]) ? formatRuntime($runtimes[$movie->getTitle()]) : '—' ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Жанр «Фантастика»</h2>
<ul>
    <?php foreach ($catalog->findByGenre('Фантастика') as $m): ?>
        <li><?= htmlspecialchars($m->getInfo()) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Топ-3 за рейтингом</h2>
<ol>
    <?php foreach ($catalog->topRated(3) as $m): ?>
        <li><?= htmlspecialchars($m->getTitle()) ?> — <?= $m->getRating() ?> <?= starsToText($m->getRating()) ?></li>
    <?php endforeach; ?>
</ol>
</body>
</html>
