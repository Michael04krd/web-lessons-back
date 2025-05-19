<?php
session_start();
require_once 'db.php';

// Удаляем защиту HTTP Basic Auth (она не нужна для этого скрипта)
// И добавляем проверку, что скрипт вызывается напрямую
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !empty($_POST)) {
    die('Доступ запрещён');
}

$db = require 'db.php';

$login = 'admin';
$password = 'admin123'; // Измените на свой пароль!

// Проверяем, существует ли уже администратор
try {
    $stmt = $db->prepare("SELECT id FROM admins WHERE login = ?");
    $stmt->execute([$login]);
    
    if ($stmt->fetch()) {
        die('Администратор уже существует');
    }

    // Создаём хеш пароля
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Добавляем администратора
    $stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
    $stmt->execute([$login, $password_hash]);
    
    echo "Администратор успешно создан.<br>";
    echo "Логин: $login<br>";
    echo "Пароль: $password<br>";
    echo '<a href="admin.php">Перейти в админку</a>';
} catch (PDOException $e) {
    error_log('Create admin error: ' . $e->getMessage());
    die("Ошибка: Не удалось создать администратора. Проверьте логи ошибок.");
}
?>
