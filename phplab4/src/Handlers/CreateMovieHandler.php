<?php
require_once __DIR__ . '/../helpers.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $genre = trim($_POST['genre']);
    $description = trim($_POST['description']);
    $director = trim($_POST['director']);
    $year = intval($_POST['year']);

    if (!$title || !$genre || !$description || !$director || !$year) {
        die("Ошибка: Все поля обязательны!");
    }

    $movie = [
        'title' => $title,
        'genre' => $genre,
        'description' => $description,
        'director' => $director,
        'year' => $year
    ];

    saveMovie($movie);
    header("Location: /index.php");
    exit;
}
