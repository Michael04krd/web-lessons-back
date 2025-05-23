<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=u68608', 'u68608', '1096993', [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);

// Проверка HTTP Basic Auth
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Admin Panel"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<!DOCTYPE html><html><head><title>Авторизация</title></head><body><h1>Требуется авторизация</h1></body></html>';
    exit;
}

$login = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// Проверка учетных данных
try {
    $stmt = $db->prepare("SELECT password_hash FROM admins WHERE login = ?");
    $stmt->execute([$login]);
    $admin = $stmt->fetch();
    
    if (!$admin || !password_verify($password, $admin['password_hash'])) {
        header('WWW-Authenticate: Basic realm="Admin Panel"');
        header('HTTP/1.0 401 Unauthorized');
        echo '<!DOCTYPE html><html><head><title>Ошибка</title></head><body><h1>Неверные учетные данные</h1></body></html>';
        exit;
    }
} catch (PDOException $e) {
    die('<!DOCTYPE html><html><head><title>Ошибка</title></head><body><h1>Ошибка базы данных</h1></body></html>');
}

// Обработка выхода
if (isset($_GET['logout'])) {
    header('Location: logout.php');
    exit;
}

// CSRF защита
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Обработка действий администратора
$messages = [];
$action = $_GET['action'] ?? '';
$id = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token'])) {
        die('Отсутствует CSRF токен');
    }
    
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Неверный CSRF токен');
    }
}

// Удаление заявки
if ($action === 'delete' && $id > 0) {
    try {
        $db->beginTransaction();
        
        $stmt = $db->prepare("DELETE FROM application_languages WHERE application_id = ?");
        $stmt->execute([$id]);
        
        $stmt = $db->prepare("DELETE FROM users WHERE application_id = ?");
        $stmt->execute([$id]);
        
        $stmt = $db->prepare("DELETE FROM application WHERE id = ?");
        $stmt->execute([$id]);
        
        $db->commit();
        $messages[] = 'Данные успешно удалены';
    } catch (PDOException $e) {
        $db->rollBack();
        $messages[] = 'Ошибка при удалении данных';
    }
}

// Получение всех заявок
try {
    $stmt = $db->query("
        SELECT a.id, a.last_name, a.first_name, a.patronymic, a.phone, a.email, 
               a.dob, a.gender, a.bio, u.login
        FROM application a
        LEFT JOIN users u ON a.id = u.application_id
        ORDER BY a.id
    ");
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($applications as &$app) {
        $stmt = $db->prepare("
            SELECT l.id, l.name 
            FROM application_languages al
            JOIN languages l ON al.language_id = l.id
            WHERE al.application_id = ?
        ");
        $stmt->execute([$app['id']]);
        $app['languages'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    unset($app);
    
    // Статистика по языкам
    $stmt = $db->query("
        SELECT l.id, l.name, COUNT(al.application_id) as user_count
        FROM languages l
        LEFT JOIN application_languages al ON l.id = al.language_id
        GROUP BY l.id, l.name
        ORDER BY user_count DESC
    ");
    $language_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Ошибка получения данных');
}

// Форма редактирования
$edit_data = null;
if ($action === 'edit' && $id > 0) {
    try {
        $stmt = $db->prepare("
            SELECT a.id, a.last_name, a.first_name, a.patronymic, a.phone, a.email, 
                   a.dob, a.gender, a.bio, u.login
            FROM application a
            LEFT JOIN users u ON a.id = u.application_id
            WHERE a.id = ?
        ");
        $stmt->execute([$id]);
        $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($edit_data) {
            $stmt = $db->prepare("
                SELECT l.id 
                FROM application_languages al
                JOIN languages l ON al.language_id = l.id
                WHERE al.application_id = ?
            ");
            $stmt->execute([$edit_data['id']]);
            $edit_data['languages'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        }
    } catch (PDOException $e) {
        $messages[] = 'Ошибка получения данных для редактирования';
    }
}

// Сохранение изменений
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_edit'])) {
    $id = (int)($_POST['id'] ?? 0);
    $last_name = trim($_POST['last_name'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $patronymic = trim($_POST['patronymic'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $languages = isset($_POST['languages']) ? array_map('intval', $_POST['languages']) : [];
    
    try {
        $db->beginTransaction();
        
        $stmt = $db->prepare("
            UPDATE application 
            SET last_name = ?, first_name = ?, patronymic = ?, phone = ?, 
                email = ?, dob = ?, gender = ?, bio = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $last_name, $first_name, $patronymic, $phone, 
            $email, $dob, $gender, $bio, $id
        ]);
        
        $stmt = $db->prepare("DELETE FROM application_languages WHERE application_id = ?");
        $stmt->execute([$id]);
        
        $stmt = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
        foreach ($languages as $lang_id) {
            $stmt->execute([$id, $lang_id]);
        }
        
        $db->commit();
        $messages[] = 'Данные успешно обновлены';
        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        $db->rollBack();
        $messages[] = 'Ошибка при обновлении данных';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .logout-btn { display: inline-block; padding: 8px 16px; background: #dc3545; color: white; text-decoration: none; border-radius: 4px; }
        .logout-btn:hover { background: #c82333; }
        .action-btn { display: inline-block; padding: 4px 8px; margin: 2px; text-decoration: none; border-radius: 3px; }
        .edit-btn { background: #28a745; color: white; }
        .delete-btn { background: #dc3545; color: white; }
        .messages { margin: 10px 0; padding: 10px; background: #f8f9fa; border: 1px solid #ddd; }
        .message { margin: 5px 0; }
        .edit-form { margin-top: 20px; padding: 20px; background: #f8f9fa; border: 1px solid #ddd; }
        .edit-form label { display: block; margin-top: 10px; }
        .edit-form input, .edit-form select, .edit-form textarea { width: 100%; padding: 8px; margin-top: 5px; }
        .edit-form select[multiple] { height: auto; min-height: 100px; }
        .form-actions { margin-top: 15px; }
        .save-btn { padding: 8px 16px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .cancel-btn { padding: 8px 16px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-left: 10px; }
    </style>
</head>
<body>
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Административная панель</h1>
            <a href="admin.php?logout=1" class="logout-btn">Выйти</a>
        </div>
        
        <?php if (!empty($messages)): ?>
        <div class="messages">
            <?php foreach ($messages as $message): ?>
                <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div style="background: #f8f9fa; padding: 20px; margin-bottom: 30px;">
            <h2>Статистика по языкам программирования</h2>
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>Язык программирования</th>
                        <th>Количество пользователей</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($language_stats as $stat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stat['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($stat['user_count'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <h2>Все заявки</h2>
        <table class="applications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Дата рождения</th>
                    <th>Пол</th>
                    <th>Языки</th>
                    <th>Логин</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                <tr>
                    <td><?php echo htmlspecialchars($app['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($app['last_name'] . ' ' . $app['first_name'] . ' ' . $app['patronymic'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($app['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($app['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($app['dob'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($app['gender'] === 'male' ? 'Мужской' : 'Женский', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php 
                            $lang_names = array_map(function($lang) { 
                                return $lang['name']; 
                            }, $app['languages']);
                            echo htmlspecialchars(implode(', ', $lang_names), ENT_QUOTES, 'UTF-8');
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($app['login'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="admin.php?action=edit&id=<?php echo (int)$app['id']; ?>" class="action-btn edit-btn">Редактировать</a>
                        <a href="admin.php?action=delete&id=<?php echo (int)$app['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if ($edit_data): ?>
        <div class="edit-form">
            <h2>Редактирование заявки #<?php echo htmlspecialchars($edit_data['id'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_data['id'], ENT_QUOTES, 'UTF-8'); ?>">
                
                <label for="last_name">Фамилия:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($edit_data['last_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                
                <label for="first_name">Имя:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($edit_data['first_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                
                <label for="patronymic">Отчество:</label>
                <input type="text" id="patronymic" name="patronymic" value="<?php echo htmlspecialchars($edit_data['patronymic'], ENT_QUOTES, 'UTF-8'); ?>">
                
                <label for="phone">Телефон:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($edit_data['phone'], ENT_QUOTES, 'UTF-8'); ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($edit_data['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                
                <label for="dob">Дата рождения:</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($edit_data['dob'], ENT_QUOTES, 'UTF-8'); ?>" required>
                
                <label for="gender">Пол:</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php echo $edit_data['gender'] === 'male' ? 'selected' : ''; ?>>Мужской</option>
                    <option value="female" <?php echo $edit_data['gender'] === 'female' ? 'selected' : ''; ?>>Женский</option>
                </select>
                
                <label for="bio">Биография:</label>
                <textarea id="bio" name="bio" required><?php echo htmlspecialchars($edit_data['bio'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                
                <label for="languages">Любимые языки программирования:</label>
                <select id="languages" name="languages[]" multiple required>
                    <?php 
                    $stmt = $db->query("SELECT id, name FROM languages");
                    $all_languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($all_languages as $lang): ?>
                        <option value="<?php echo (int)$lang['id']; ?>" <?php echo in_array($lang['id'], $edit_data['languages']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($lang['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <div class="form-actions">
                    <button type="submit" name="save_edit" class="save-btn">Сохранить</button>
                    <a href="admin.php" class="cancel-btn">Отмена</a>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
