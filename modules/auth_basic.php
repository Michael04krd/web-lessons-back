<?php
require_once __DIR__ . '/../scripts/db.php';

function auth(&$request, $r) {
    $db = db_connect();
    
    $users = [];
    $stmt = $db->query("SELECT login, password FROM admins UNION SELECT login, password FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $users[$row['login']] = $row['password'];
    }

    if (empty($user) && !empty($_SERVER['PHP_AUTH_USER'])) {
        $login = $_SERVER['PHP_AUTH_USER'];
        if (isset($users[$login])) {
            $user = [
                'login' => $login,
                'pass' => $users[$login] 
            ];
            $request['user'] = $user;
        }
    }

    if (!isset($_SERVER['PHP_AUTH_USER']) || 
        empty($user) || 
        $_SERVER['PHP_AUTH_USER'] != $user['login'] || 
        !password_verify($_SERVER['PHP_AUTH_PW'], $user['pass'])) {
        
        unset($user);
        $response = [
            'headers' => [
                sprintf('WWW-Authenticate: Basic realm="%s"', conf('sitename')), 
                'HTTP/1.0 401 Unauthorized'
            ],
            'entity' => theme('401', $request),
        ];
        return $response;
    }
}