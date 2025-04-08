<?php
require_once __DIR__ . '/../../src/helpers.php';

$movies = getMovies();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все фильмы</title>
</head>
<body>
    <h1>Список фильмов</h1>
    <a href="../index.php">На главную</a>
    <?php if (empty($movies)): ?>
        <p>Фильмов пока нет.</p>
    <?php else: ?>
    <ul>
        <?php foreach ($movies as $movie): ?>
            <li><strong><?= htmlspecialchars($movie['title']) ?></strong> (<span><?= htmlspecialchars($movie['genre']) ?>, <?= htmlspecialchars($movie['year']) ?></span>) - <?= htmlspecialchars($movie['description']) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</body>
</html>
