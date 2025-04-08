<?php
require_once __DIR__ . '/../helpers.php';

function handleCreateMovie($postData) {
    $title = trim($postData['title']);
    $genre = trim($postData['genre']);
    $description = trim($postData['description']);
    $director = trim($postData['director']);
    $year = intval($postData['year']);

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    handleCreateMovie($_POST);
}
