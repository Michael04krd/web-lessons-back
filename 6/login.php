<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

if (!empty($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$user = 'u68608';
$pass = '1096993';
$db = new PDO('mysql:host=localhost;dbname=u68608', $user, $pass, [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$messages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['pass'] ?? '');

    try {
        $stmt = $db->prepare("SELECT id, login, password FROM users WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['uid'] = $user['id'];
            header('Location: index.php');
            exit();
        } else {
            $messages[] = 'Неверный логин или пароль';
        }
    } catch (PDOException $e) {
        $messages[] = 'Ошибка при входе в систему';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Вход в систему</title>
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Вход в систему</h1>
        
        <?php if (!empty($messages)): ?>
        <div class="login-messages">
            <?php foreach ($messages as $message): ?>
                <div class="error-message"><?php echo htmlspecialchars($message); ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <form class="login-form" method="POST">
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login" required>
            </div>
            
            <div class="form-group">
                <label for="pass">Пароль:</label>
                <input type="password" id="pass" name="pass" required>
            </div>
            
            <div class="login-actions">
                <input type="submit" value="Войти">
            </div>
        </form>
        
        <div class="register-link">
            Нет аккаунта? <a href="index.php">Заполните форму регистрации</a>
        </div>
    </div>
</body>
</html>