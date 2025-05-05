<?php
$user = 'u68608';
$pass = '1096993';
$db = new PDO('mysql:host=localhost;dbname=u68608', $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$login = 'admin'; // Логин администратора
$password = 'admin123'; // Пароль администратора

$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
    $stmt->execute([$login, $password_hash]);
    echo "Администратор успешно создан. Логин: $login, Пароль: $password";
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>