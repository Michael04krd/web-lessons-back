<?php
session_start();

// Уничтожаем все данные сессии
$_SESSION = array();

// Если выходим из админки, убиваем и HTTP Basic Auth
if (isset($_GET['admin'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Restricted Area"');
}

// Удаляем сессионную cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Уничтожаем сессию
session_destroy();

// Перенаправляем на главную
header('Location: index.php');
exit();
?>
