<?php
require_once __DIR__ . '/../src/helpers.php';

$movies = getMovies();
$latestMovies = array_reverse(array_slice($movies, -2));
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог фильмов</title>
</head>
<body>
    <h1>Каталог фильмов</h1>
    <a href="/../movie/create.php">Добавить фильм</a>
    <h2>Последние фильмы:</h2>
    <?php if (empty($latestMovies)): ?>
        <p>Фильмов пока нет.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($latestMovies as $movie): ?>
                <li><strong><?= htmlspecialchars($movie['title']) ?></strong> (<span><?= htmlspecialchars($movie['genre']) ?>, <?= htmlspecialchars($movie['year']) ?></span>) - <?= htmlspecialchars($movie['description']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="/../movie/index.php">Смотреть все фильмы</a>
</body>
</html>
