<?php
session_start();

// Уничтожаем сессию
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Сбрасываем HTTP Basic Auth
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Logged Out"');

// Перенаправляем на главную
header('Location: index.php');
exit;
?>
