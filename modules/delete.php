<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../scripts/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../admin');
    exit;
}

$id = (int)$_GET['id'];
$db = db_connect();

$stmt = $db->prepare("DELETE FROM application_languages WHERE application_id = ?");
$stmt->execute([$id]);

$stmt = $db->prepare("DELETE FROM applications WHERE id = ?");
$stmt->execute([$id]);

header('Location: ../admin');
exit;