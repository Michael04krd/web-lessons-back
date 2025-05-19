<?php
$db = require 'db.php';

$login = 'admin';
$password = 'admin123'; // Ваш пароль

$stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
$stmt->execute([$login, password_hash($password, PASSWORD_DEFAULT)]);

echo "Админ создан. Логин: $login, Пароль: $password";
?>
