<?php
session_start();

// Защита от прямого доступа
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'superadminpass') {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die('Доступ запрещен');
}

$db = require 'db.php';

$login = 'admin';
$password = 'admin123';

// Генерация соли и хеша пароля
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Проверка существования администратора
    $stmt = $db->prepare("SELECT id FROM admins WHERE login = ?");
    $stmt->execute([$login]);
    
    if ($stmt->fetch()) {
        die('Администратор уже существует');
    }

    // Создание администратора
    $stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
    $stmt->execute([$login, $password_hash]);
    
    echo "Администратор успешно создан. Логин: $login, Пароль: $password";
} catch (PDOException $e) {
    error_log('Create admin error: ' . $e->getMessage());
    die("Ошибка: Не удалось создать администратора");
}
?>