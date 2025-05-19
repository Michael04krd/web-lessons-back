<?php
session_start();

// Уничтожаем сессию админки
unset($_SESSION['admin_logged_in']);

// Сбрасываем HTTP Basic Auth
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Logged Out"');

// Перенаправляем на главную
header('Location: index.php');
exit;
?>
