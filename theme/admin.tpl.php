<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/backend-s0188267.github.io/project/styles/admin.css">
</head>
<body>
    <div class="admin-container">
        <h1>Админ-панель</h1>
        <a href="/backend-s0188267.github.io/project/modules/logout.php" class="button admin-logout">Выйти</a>

        <div class="stats">
            <h2>Статистика по языкам программирования</h2>
            <table>
                <thead>
                    <tr><td>Язык</td><td>Количество выборов</td></tr>
                </thead>
                <tbody>
                    <?php foreach ($stats as $stat): ?>
                    <tr>
                        <td><?= htmlspecialchars($stat['name']) ?></td>
                        <td><?= isset($stat['count']) ? (int)$stat['count'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Все заявки пользователей (всего: <?= count($processedApplications ?? []) ?>)</h2>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Пользователь</td>
                    <td>ФИО</td>
                    <td>Email</td>
                    <td>Телефон</td>
                    <td>Дата рождения</td>
                    <td>Пол</td>
                    <td>Языки</td>
                    <td>Биография</td>
                    <td>Согласие</td>
                    <td>Действия</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($processedApplications as $app): ?>
                <tr>
                    <td><?= $app['id'] ?></td>
                    <td><?= htmlspecialchars($app['user_login'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($app['full_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['email'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['phone'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['birth_date'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['gender_short'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($app['languages'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(substr($app['biography'] ?? '', 0, 50)) ?><?= strlen($app['biography'] ?? '') > 50 ? '...' : '' ?></td>
                    <td><?= isset($app['agreement']) && $app['agreement'] ? 'Да' : 'Нет' ?></td>
                    <td class="buttons">
                        <div class="change_button">
                            <a href="/backend-s0188267.github.io/project/modules/edit.php?id=<?= $app['id'] ?>">Редактировать</a>
                        </div>
                        <button class="delete_button" onclick="if(confirm('Удалить эту заявку?')) location.href='/backend-s0188267.github.io/project/modules/delete.php?id=<?= $app['id'] ?>'">Удалить</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>