<?php
if (isset($_POST['url'])) {
    $url = escapeshellarg($_POST['url']);
    $command = "youtube-dl -F $url";
    $output = shell_exec($command);

    if (strpos($output, 'Video formats') !== false) {
        $formats = explode("\n", trim($output));
        array_shift($formats); // Удаляем первую строку
        array_shift($formats); // Удаляем строку с описанием форматов

        echo "<h2>Доступные форматы для загрузки:</h2>";
        echo "<ul>";
        foreach ($formats as $format) {
            if (trim($format)) {
                echo "<li>$format</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "Не удалось получить информацию о видео.";
    }
} else {
?>
    <form method="POST" action="">
        <label for="url">Введите URL видео на YouTube:</label>
        <input type="text" name="url" id="url" required>
        <button type="submit">Получить ссылки для скачивания</button>
    </form>
<?php
}
?>
