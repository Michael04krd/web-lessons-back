<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkAdminAuth() {
    if (empty($_SESSION['login']) || empty($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header('Location: login.php?error=' . urlencode('Доступ запрещен'));
        exit;
    }
}