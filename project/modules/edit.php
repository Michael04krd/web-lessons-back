<?php
require_once '../scripts/db.php';
//require_once '../scripts/init.php';
require_once './auth.php';

checkAdminAuth();

$db = db_connect();
$appId = $_GET['id'] ?? null;

if (!$appId) {
    http_response_code(400);
    exit('Не передан ID заявки.');
}

$allLangs = db_all("SELECT * FROM programming_languages");

$app = db_row("SELECT * FROM applications WHERE id = ?", $appId);
if (!$app) {
    http_response_code(404);
    exit("Заявка не найдена");
}

$selectedLangs = db_all("SELECT language_id FROM application_languages WHERE application_id = ?", $appId);
$selectedLangs = array_column($selectedLangs, 'language_id');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    db_query("UPDATE applications SET full_name = ?, email = ?, phone = ?, gender = ?, biography = ?, agreement = ? WHERE id = ?",
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['gender'],
        $_POST['biography'],
        isset($_POST['agreement']) ? 1 : 0,
        $appId
    );

    db_query("DELETE FROM application_languages WHERE application_id = ?", $appId);
    if (!empty($_POST['languages'])) {
        foreach ($_POST['languages'] as $langId) {
            db_query("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)", $appId, $langId);
        }
    }

    header('Location: admin.php');
    exit();
}

include __DIR__ . '/../theme/edit_form.tpl.php';