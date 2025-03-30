# Каталог фильмов

## Описание проекта  
Проект представляет собой веб-приложение для хранения каталога фильмов. Оно позволяет добавлять новые фильмы, просматривать список всех фильмов и отображать последние добавленные.

## Инструкции по запуску  

### Требования:  
- PHP 7.4+  
- Веб-сервер (Apache, Nginx)  
- Поддержка `file_put_contents()` и `file_get_contents()`

### Установка и запуск:  
1. Клонируйте репозиторий или загрузите файлы проекта.  
2. Разместите проект в корневой директории веб-сервера.  
3. Убедитесь, что папка `storage` существует и доступна для записи.  
4. Запустите сервер:  
   ```sh
   php -S localhost:8000 -t public/
   ```
5. Откройте в браузере `http://localhost:8000`.

## Описание функционала  

### Основные возможности:  
- Добавление фильмов через форму  
- Просмотр списка всех фильмов  
- Отображение последних добавленных фильмов  

### Структура проекта:  
```
phplab4/
│── public/
│   │── movie/
│   │   ├── create.php  # Страница добавления фильма
│   │   ├── index.php   # Страница со списком всех фильмов
│   ├──index.php  # Главная страница
│── src/
│   ├──Handlers/
│   │   ├──CreateMovieHandler.php
│   ├── helpers.php  # Вспомогательные функции
│── storage/
│   ├── movies.txt  # Хранилище фильмов (файл)
│── README.md  # Описание проекта
```

## Краткая документация  

### `src/helpers.php`  
- **`getMovies()`** — Получает список фильмов из файла.  
- **`saveMovie($movie)`** — Сохраняет новый фильм в файл.  

### Страница `movie/create.php`  
Страница с формой для добавления нового фильма.

```html
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
```

### Функция обработки данных `helpers.php`

```php
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
```

### Страница `movie/index.php`  
Страница, отображающая список всех фильмов и последние добавленные фильмы.

```php
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
    <a href="/movie/create.php">Добавить фильм</a>
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
    <a href="/movie/index.php">Смотреть все фильмы</a>
</body>
</html>
```

## Примеры использования  

### Добавление фильма  
Фрагмент кода формы (`movie/create.php`):  
```html
<form action="create.php" method="post">
    <label>Название фильма: <input type="text" name="title" required></label><br><br>
    <label>Жанр:
        <select name="genre">
            <option value="Драма">Драма</option>
            <option value="Комедия">Комедия</option>
        </select>
    </label><br><br>
    <label>Описание: <textarea name="description" required></textarea></label><br><br>
    <label>Режиссёр: <input type="text" name="director" required></label><br><br>
    <label>Год выпуска: <input type="number" name="year" min="1900" max="<?= date('Y') ?>" required></label><br><br>
    <button type="submit">Сохранить</button>
</form>
```

### Обработка данных в `helpers.php`  
```php
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
```

## Ответы на контрольные вопросы  

1. **Какие методы HTTP применяются для отправки данных формы?**  
   - Основные методы: `GET` и `POST`.  
   - `GET` передаёт данные через URL, подходит для поиска.  
   - `POST` передаёт данные в теле запроса, используется для отправки форм.

2. **Что такое валидация данных, и чем она отличается от фильтрации?**  
   - Валидация проверяет, соответствует ли ввод заданным критериям (например, длина строки, формат даты).  
   - Фильтрация очищает данные от потенциально вредоносного содержимого (удаление тегов, экранирование).

3. **Какие функции PHP используются для фильтрации данных?**  
   - `htmlspecialchars()` — защищает от XSS.  
   - `filter_var($var, FILTER_SANITIZE_STRING)` — удаляет нежелательные символы.  
   - `trim()` — убирает пробелы в начале и конце строки.

## Источники  
- [PHP Manual](https://www.php.net/manual/)  
- [MDN Web Docs](https://developer.mozilla.org/)