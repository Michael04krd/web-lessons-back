<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');

$db = require 'db.php';

function getLangs($db) {
    try {
        $allowed_lang = [];
        $data = $db->query("SELECT id, name FROM languages")->fetchAll();
        foreach ($data as $lang) {
            $allowed_lang[$lang['id']] = $lang['name'];
        }
        return $allowed_lang;
    } catch(PDOException $e) {
        error_log('Get languages error: ' . $e->getMessage());
        die('Ошибка загрузки языков');
    }
}
$allowed_lang = getLangs($db);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    $errors = array();
    $values = array();

    $fields = ['full_name', 'phone', 'email', 'birth_day', 'birth_month', 'birth_year', 'gender', 'biography', 'languages', 'agreement'];
    foreach ($fields as $field) {
        $errors[$field] = !empty($_COOKIE[$field . '_error']);
        $values[$field] = empty($_COOKIE[$field . '_value']) ? '' : $_COOKIE[$field . '_value'];
    }

    foreach ($fields as $field) {
        setcookie($field . '_error', '', time() - 3600);
    }

    if ($errors['full_name']) {
        $messages['full_name'] = match($_COOKIE['full_name_error']) {
            '1' => 'Имя не указано.',
            '2' => 'Имя не должно превышать 150 символов.',
            '3' => 'Имя может содержать только буквы и пробелы.',
            default => 'Некорректное имя.'
        };
    }
    
    if ($errors['phone']) {
        $messages['phone'] = match($_COOKIE['phone_error']) {
            '1' => 'Телефон не указан.',
            '2' => 'Телефон должен быть в формате +7XXXXXXXXXX.',
            default => 'Некорректный телефон.'
        };
    }
    
    if ($errors['email']) {
        $messages['email'] = match($_COOKIE['email_error']) {
            '1' => 'Email не указан.',
            '2' => 'Email должен быть в формате example@domain.com.',
            default => 'Некорректный email.'
        };
    }
    
    if ($errors['birth_day'] || $errors['birth_month'] || $errors['birth_year']) {
        $messages['birth_date'] = 'Некорректная дата рождения.';
    }
    
    if ($errors['gender']) {
        $messages['gender'] = match($_COOKIE['gender_error']) {
            '1' => 'Пол не указан.',
            '2' => 'Недопустимое значение пола.',
            default => 'Некорректный пол.'
        };
    }
    
    if ($errors['biography']) {
        $messages['biography'] = match($_COOKIE['biography_error']) {
            '1' => 'Биография не указана.',
            '2' => 'Биография не должна превышать 512 символов.',
            '3' => 'Биография содержит недопустимые символы.',
            default => 'Некорректная биография.'
        };
    }
    
    if ($errors['languages']) {
        $messages['languages'] = match($_COOKIE['languages_error']) {
            '1' => 'Не выбран язык программирования.',
            '2' => 'Выбран недопустимый язык программирования.',
            default => 'Некорректные языки программирования.'
        };
    }
    
    if ($errors['agreement']) {
        $messages['agreement'] = 'Необходимо согласие с контрактом.';
    }

    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() - 3600);
        $messages[] = 'Спасибо, результаты сохранены.';
    }

    // Загрузка данных для авторизованного пользователя
    if (!empty($_SESSION['login'])) {
        try {
            $stmt = $db->prepare("SELECT a.* FROM application a JOIN users u ON a.id = u.application_id WHERE u.login = ?");
            $stmt->execute([$_SESSION['login']]);
            $application = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($application) {
                $values['full_name'] = $application['last_name'] . ' ' . $application['first_name'] . ' ' . $application['patronymic'];
                $values['phone'] = $application['phone'];
                $values['email'] = $application['email'];
                $values['birth_day'] = date('d', strtotime($application['dob']));
                $values['birth_month'] = date('m', strtotime($application['dob']));
                $values['birth_year'] = date('Y', strtotime($application['dob']));
                $values['gender'] = $application['gender'];
                $values['biography'] = $application['bio'];
                $values['agreement'] = 1;

                $stmt = $db->prepare("SELECT language_id FROM application_languages WHERE application_id = ?");
                $stmt->execute([$application['id']]);
                $selected_langs = $stmt->fetchAll(PDO::FETCH_COLUMN);
                $values['languages'] = implode(',', $selected_langs);
            }
        } catch (PDOException $e) {
            error_log('Load user data error: ' . $e->getMessage());
            die('Ошибка загрузки данных');
        }
    }

    include('form.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверка CSRF токена
    if (!isset($_POST['csrf_token'])) {
        die('CSRF token missing');
    }
    
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $errors = FALSE;

    $full_name = trim($_POST['full_name'] ?? '');
    $num = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $day = trim($_POST['birth_day'] ?? '');
    $month = trim($_POST['birth_month'] ?? ''); 
    $year = trim($_POST['birth_year'] ?? '');
    $biography = trim($_POST['biography'] ?? '');
    $gen = $_POST['gender'] ?? '';
    $languages = is_array($_POST['languages']) ? $_POST['languages'] : [];
    $agreement = isset($_POST['agreement']) && $_POST['agreement'] === 'on' ? 1 : 0;

    // Разделяем ФИО на составляющие
    $name_parts = explode(' ', $full_name);
    $last_name = $name_parts[0] ?? '';
    $first_name = $name_parts[1] ?? '';
    $patronymic = $name_parts[2] ?? '';

    if (empty($full_name)) {
        setcookie('full_name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (strlen($full_name) > 150) {
        setcookie('full_name_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s]+$/u', $full_name)) {
        setcookie('full_name_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('full_name_value', $full_name, time() + 365 * 24 * 60 * 60);

    if (empty($num)) {
        setcookie('phone_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (!preg_match('/^\+7\d{10}$/', $num)) {
        setcookie('phone_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('phone_value', $num, time() + 365 * 24 * 60 * 60);

    if (empty($email)) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setcookie('email_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('email_value', $email, time() + 365 * 24 * 60 * 60);

    if (empty($gen)) {
        setcookie('gender_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (!in_array($gen, ["male", "female"])) {
        setcookie('gender_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('gender_value', $gen, time() + 365 * 24 * 60 * 60);

    if (empty($biography)) {
        setcookie('biography_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (strlen($biography) > 512) {
        setcookie('biography_error', '2', time() + 24 * 60 * 60);
        $errors = TRUE;
    } elseif (preg_match('/[<>{}\[\]]|<script|<\?php/i', $biography)) {
        setcookie('biography_error', '3', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('biography_value', $biography, time() + 365 * 24 * 60 * 60);

    if (empty($languages)) {
        setcookie('languages_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        $invalid_langs = array_diff($languages, array_keys($allowed_lang));
        if (!empty($invalid_langs)) {
            setcookie('languages_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        }
    }
    setcookie('languages_value', implode(',', $languages), time() + 365 * 24 * 60 * 60);

    if (!checkdate($month, $day, $year)) {
        setcookie('birth_day_error', '1', time() + 24 * 60 * 60);
        setcookie('birth_month_error', '1', time() + 24 * 60 * 60);
        setcookie('birth_year_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('birth_day_value', $day, time() + 365 * 24 * 60 * 60);
    setcookie('birth_month_value', $month, time() + 365 * 24 * 60 * 60);
    setcookie('birth_year_value', $year, time() + 365 * 24 * 60 * 60);

    if (!$agreement) {
        setcookie('agreement_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    setcookie('agreement_value', $agreement, time() + 365 * 24 * 60 * 60);

    if ($errors) {
        header('Location: index.php');
        exit();
    }

    $fields = ['full_name', 'phone', 'email', 'birth_day', 'birth_month', 'birth_year', 'gender', 'biography', 'languages', 'agreement'];
    foreach ($fields as $field) {
        setcookie($field . '_error', '', time() - 3600);
    }

    try {
        $birth_date = sprintf("%04d-%02d-%02d", $year, $month, $day);

        if (!empty($_SESSION['login'])) {
            // Обновляем существующую заявку
            $stmt = $db->prepare("UPDATE application SET first_name = ?, last_name = ?, patronymic = ?, phone = ?, email = ?, dob = ?, gender = ?, bio = ? WHERE id = (SELECT application_id FROM users WHERE login = ?)");
            $stmt->execute([$first_name, $last_name, $patronymic, $num, $email, $birth_date, $gen, $biography, $_SESSION['login']]);

            // Получаем ID заявки
            $stmt = $db->prepare("SELECT application_id FROM users WHERE login = ?");
            $stmt->execute([$_SESSION['login']]);
            $application_id = $stmt->fetchColumn();

            // Обновляем языки
            $db->beginTransaction();
            $stmt = $db->prepare("DELETE FROM application_languages WHERE application_id = ?");
            $stmt->execute([$application_id]);

            $stmt = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
            foreach ($languages as $lang_id) {
                $stmt->execute([$application_id, (int)$lang_id]);
            }
            $db->commit();
        } else {
            // Создаем новую заявку
            $stmt = $db->prepare("INSERT INTO application (first_name, last_name, patronymic, phone, email, dob, gender, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $patronymic, $num, $email, $birth_date, $gen, $biography]);
            $application_id = $db->lastInsertId();

            // Добавляем языки
            $stmt = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
            foreach ($languages as $lang_id) {
                $stmt->execute([$application_id, (int)$lang_id]);
            }

            // Создаем пользователя
            $login = uniqid('user_');
            $pass = bin2hex(random_bytes(8));
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (login, password, application_id) VALUES (?, ?, ?)");
            $stmt->execute([$login, $pass_hash, $application_id]);

            $_SESSION['generated_login'] = $login;
            $_SESSION['generated_password'] = $pass;
        }

        setcookie('save', '1', time() + 24 * 60 * 60);
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        if (isset($db) && $db->inTransaction()) {
            $db->rollBack();
        }
        error_log('Save error: ' . $e->getMessage());
        die('Ошибка сохранения данных');
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
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
        
        <div class="stats-container">
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
