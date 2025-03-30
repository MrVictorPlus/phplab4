<?php
define('MOVIE_STORAGE', __DIR__ . '../../storage/movies.txt');

function getMovies() {
    if (!file_exists(MOVIE_STORAGE)) {
        return [];
    }

    $lines = file(MOVIE_STORAGE, FILE_IGNORE_NEW_LINES);
    return array_map('json_decode', $lines, array_fill(0, count($lines), true));
}

function saveMovie($movie) {
    file_put_contents(MOVIE_STORAGE, json_encode($movie) . PHP_EOL, FILE_APPEND);
}

function handleCreateMovie($postData) {
    $title = trim($postData['title']);
    $genre = trim($postData['genre']);
    $description = trim($postData['description']);
    $director = trim($postData['director']);
    $year = intval($postData['year']);

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
?>
