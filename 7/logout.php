<?php
session_start();

// Уничтожаем все данные сессии
$_SESSION = array();

// Удаляем сессионную cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Уничтожаем сессию
session_destroy();

// Регенерируем ID сессии для защиты от session fixation
session_regenerate_id(true);

header('Location: index.php');
exit();
?>