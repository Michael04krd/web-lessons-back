<?php
// scripts/db.php

$db = null;

function db_connect() {
    global $db;
    if ($db !== null) return $db;

    $user = 'u68608';
    $pass = '1096993';
    $dsn = 'mysql:host=localhost;dbname=u68608;charset=utf8mb4';

    try {
        $db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]);
        return $db;
    } catch (PDOException $e) {
        error_log("DB Connection Error: " . $e->getMessage());
        throw new Exception("Ошибка подключения к базе данных.");
    }
}

function db_query($query, ...$params) {
    $db = db_connect();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt;
}

function db_row($query, ...$params) {
    return db_query($query, ...$params)->fetch();
}

function db_result($query, ...$params) {
    $row = db_row($query, ...$params);
    return $row ? reset($row) : null;
}

function db_all($query, ...$params) {
    return db_query($query, ...$params)->fetchAll();
}

function db_command($query, ...$params) {
    return db_query($query, ...$params)->rowCount();
}

function db_insert_id() {
    return db_connect()->lastInsertId();
}

function user_login_check($login) {
$row = db_row("SELECT id FROM users WHERE login = ?", $login);
return $row !== false;
}

function user_password_check($login, $password) {
$row = db_row("SELECT password_hash FROM users WHERE login = ?", $login);
return $row && password_verify($password, $row['password_hash']);
}

function admin_login_check($login) {
    $row = db_row("SELECT id FROM admins WHERE login = ?", $login);
    return $row !== false;
}

function admin_password_check($login, $password) {
    $row = db_row("SELECT password_hash FROM admins WHERE login = ?", $login);
    return $row && password_verify($password, $row['password_hash']);
}

function getLangs() {
    $db = db_connect();
    $stmt = $db->query("SELECT id, name FROM languages");

    $langs = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $langs[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }

    return $langs;
}
