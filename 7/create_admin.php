<?php
$db = new PDO('mysql:host=localhost;dbname=u68608', 'u68608', '1096993', [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$login = 'admin';
$password = 'admin123';

try {
    $stmt = $db->prepare("INSERT INTO admins (login, password_hash) VALUES (?, ?)");
    $stmt->execute([$login, password_hash($password, PASSWORD_DEFAULT)]);
    
    echo "Администратор создан:<br>";
    echo "Логин: $login<br>";
    echo "Пароль: $password<br>";
    echo '<a href="admin.php">Перейти в админку</a>';
} catch (PDOException $e) {
    die("Ошибка создания администратора");
}
?>
