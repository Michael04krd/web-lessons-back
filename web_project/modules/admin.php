<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../scripts/db.php';

checkAdminAuth();

function admin_get() {
    $db = db_connect();

    $stats = $db->query("
        SELECT p.name, COUNT(DISTINCT al.application_id) as count
        FROM programming_languages p
        LEFT JOIN application_languages al ON p.id = al.language_id
        GROUP BY p.id
        ORDER BY count DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

    $applications = $db->query("
        SELECT * FROM applications ORDER BY id ASC
    ")->fetchAll(PDO::FETCH_ASSOC);

    $processedApplications = [];

    foreach ($applications as $app) {
        $stmt = $db->prepare("
            SELECT u.login FROM users u
            JOIN user_applications ua ON u.id = ua.user_id
            WHERE ua.application_id = ?
        ");
        $stmt->execute([$app['id']]);
        $app['user_login'] = $stmt->fetchColumn() ?: '—';

        $stmt = $db->prepare("
            SELECT GROUP_CONCAT(p.name SEPARATOR ', ')
            FROM programming_languages p
            JOIN application_languages al ON p.id = al.language_id
            WHERE al.application_id = ?
        ");
        $stmt->execute([$app['id']]);
        $app['languages'] = $stmt->fetchColumn() ?: 'Не указано';

        $app['gender_short'] = $app['gender'] === 'male' ? 'м' : ($app['gender'] === 'female' ? 'ж' : '—');

        $app['agreement_text'] = (int)$app['agreement'] === 1 ? 'Да' : 'Нет';

        $processedApplications[] = $app;
    }

    return [
        'stats' => $stats,
        'processedApplications' => $processedApplications  
    ];
}

$data = admin_get($db);
$stats = $data['stats'];
$processedApplications = $data['processedApplications'];

require_once __DIR__ . '/../theme/admin.tpl.php';