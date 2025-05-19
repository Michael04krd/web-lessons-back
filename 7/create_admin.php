<?php
$db = require 'db.php';

$login = 'admin';
$password = 'admin123';

try {
    $stmt = $db->prepare("SELECT id FROM admins WHERE login = ?");
    $stmt->execute([$login]);
    
    if ($stmt->fetch()) {
        die('Администратор уже существует');
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
    $stmt->execute([$login, $password_hash]);
    
    echo "Администратор успешно создан.<br>";
    echo "Логин: $login<br>";
    echo "Пароль: $password<br>";
    echo '<a href="admin.php">Перейти в админку</a>';
} catch (PDOException $e) {
    die("Ошибка: Не удалось создать администратора");
}
?>
