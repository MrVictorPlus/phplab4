<?php
define('MOVIE_STORAGE', __DIR__ . '/../storage/movies.txt');

function saveMovie($movie) {
    file_put_contents(MOVIE_STORAGE, json_encode($movie) . PHP_EOL, FILE_APPEND);
}

function getMovies() {
    if (!file_exists(MOVIE_STORAGE)) {
        return [];
    }

    $lines = file(MOVIE_STORAGE, FILE_IGNORE_NEW_LINES);
    return array_map('json_decode', $lines, array_fill(0, count($lines), true));
}

