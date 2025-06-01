<?php
require_once __DIR__ . '/../scripts/db.php';

function login_get($request) {
    if (!empty($_SESSION['login'])) {
        return redirect('');
    }

    $generated_data = [];
    if (!empty($_SESSION['generated_login']) && !empty($_SESSION['generated_password'])) {
        $generated_data = [
            'login' => $_SESSION['generated_login'],
            'password' => $_SESSION['generated_password']
        ];
        unset($_SESSION['generated_login'], $_SESSION['generated_password']);
    }

    return theme('login', [
        'generated' => $generated_data,
        'error' => $request['get']['error'] ?? ''
    ]);
}

function login_post($request) {
    $db = db_connect();
    $login = trim($request['post']['login'] ?? '');
    $password = trim($request['post']['password'] ?? '');

    try {
        $stmt = $db->prepare("SELECT * FROM admins WHERE login = ?");
        $stmt->execute([$login]);

        if ($admin = $stmt->fetch()) {
            if (password_verify($password, $admin['password_hash'])) {
                $_SESSION['admin'] = true;
                $_SESSION['login'] = $admin['login'];
                return redirect('admin');
            } else {
                return redirect('login?error=' . urlencode('Неверный пароль администратора'));
            }
        }

        $stmt = $db->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);

        if ($user = $stmt->fetch()) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user'] = true;
                $_SESSION['login'] = $user['login'];
                return redirect('');
            } else {
                return redirect('login?error=' . urlencode('Неверный пароль пользователя'));
            }
        }

        return redirect('login?error=' . urlencode('Пользователь не найден'));
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return redirect('login?error=' . urlencode('Ошибка базы данных'));
    }
}