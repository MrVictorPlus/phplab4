<?php

require_once __DIR__ . '/../../src/helpers.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handleCreateMovie($_POST);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить фильм</title>
</head>
<body>
    <h1>Добавить фильм</h1>
    <form action="create.php" method="post">
        <label>Название фильма: <input type="text" name="title" required></label><br><br>

        <label>Жанр:
            <select name="genre">
                <option value="Драма">Драма</option>
                <option value="Комедия">Комедия</option>
                <option value="Фантастика">Фантастика</option>
                <option value="Боевик">Боевик</option>
            </select>
        </label><br><br>

        <label>Описание: <textarea name="description" required></textarea></label><br><br>

        <label>Режиссёр: <input type="text" name="director" required></label><br><br>

        <label>Год выпуска: <input type="number" name="year" min="1900" max="<?= date('Y') ?>" required></label><br><br>

        <button type="submit">Сохранить</button>
    </form>
</body>
</html>
