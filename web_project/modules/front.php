
<?php
require_once __DIR__ . '/../scripts/db.php';

function front_get($request) {
    $messages = [];
    $errors = [];
    $values = [];
    $allowed_lang = getLangs();
    $all_fields = [
        'fio', 'phone', 'email', 'birth_day', 'birth_month', 'birth_year',
        'gender', 'biography', 'languages', 'agreement'
    ];

    if (!empty($_SESSION['login'])) {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT a.*, GROUP_CONCAT(al.language_id) as languages
            FROM users u
            JOIN user_applications ua ON ua.user_id = u.id
            JOIN applications a ON a.id = ua.application_id
            LEFT JOIN application_languages al ON al.application_id = a.id
            WHERE u.login = ?
            GROUP BY a.id
        ");
        $stmt->execute([$_SESSION['login']]);
        $row = $stmt->fetch();

        if ($row) {
            $values = [
                'fio' => $row['full_name'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'birth_day' => date('d', strtotime($row['birth_date'])),
                'birth_month' => date('m', strtotime($row['birth_date'])),
                'birth_year' => date('Y', strtotime($row['birth_date'])),
                'gender' => $row['gender'],
                'biography' => $row['biography'],
                'languages' => explode(',', $row['languages']),
                'agreement' => $row['agreement']
            ];
        }
   } else {
        foreach ($all_fields as $field) {
            $errors[$field] = !empty($_COOKIE["{$field}_error"])
                ? getErrorMessage($field, $_COOKIE["{$field}_error"])
                : '';

            if ($field === 'languages') {
                if (!empty($_COOKIE["{$field}_value"])) {
                    $langs = explode(',', $_COOKIE["{$field}_value"]);
                    $values[$field] = array_filter($langs, function($item) {
                        return !empty($item);
                    });
                } else {
                    $values[$field] = [];
                }
            } else {
                $values[$field] = $_COOKIE["{$field}_value"] ?? '';
            }

            setcookie("{$field}_error", '', time() - 3600, '/');
        }

        if (!empty($_COOKIE['save'])) {
            $messages[] = 'Спасибо, результаты сохранены.';
            setcookie('save', '', time() - 3600, '/');
        }
    }

    return theme('form', [
        'messages' => $messages,
        'errors' => $errors,
        'values' => $values,
        'allowed_lang' => $allowed_lang
    ]);
}

function front_post($request) {
    $db = db_connect();
    if (!$db) {
        return ['success' => false, 'errors' => ['db' => 'Ошибка подключения к БД']];
    }

    $is_ajax = $request['is_ajax'] ?? false;
    $post_data = $request['post'] ?? $_POST;

    $required_fields = [
        'fio' => 'Укажите ФИО',
        'phone' => 'Укажите телефон',
        'email' => 'Укажите email',
        'birth_day' => 'Укажите день рождения',
        'birth_month' => 'Укажите месяц рождения',
        'birth_year' => 'Укажите год рождения',
        'gender' => 'Укажите пол',
        'biography' => 'Напишите биографию',
        'languages' => 'Выберите хотя бы один язык',
        'agreement' => 'Необходимо ваше согласие'
    ];

    $errors = [];
    $values = [];

    foreach ($required_fields as $field => $error_message) {
        if ($field === 'languages') {
            $values[$field] = isset($post_data['languages']) && is_array($post_data['languages']) 
                ? $post_data['languages'] 
                : [];
            if (empty($values[$field])) {
                $errors[$field] = $error_message;
            }
        } elseif ($field === 'agreement') {
            $values[$field] = isset($post_data['agreement']) ? 1 : 0;
            if (!$values[$field]) {
                $errors[$field] = $error_message;
            }
        } else {
            $values[$field] = trim($post_data[$field] ?? '');
            if (empty($values[$field])) {
                $errors[$field] = $error_message;
            }
        }
    }

    if (!isset($errors['birth_day']) && !isset($errors['birth_month']) && !isset($errors['birth_year'])) {
        if (!checkdate(
            (int)$values['birth_month'], 
            (int)$values['birth_day'], 
            (int)$values['birth_year']
        )) {
            $errors['birth_day'] = 'Некорректная дата';
            $errors['birth_month'] = 'Некорректная дата';
            $errors['birth_year'] = 'Некорректная дата';
        }
    }

    foreach ($values as $key => $val) {
        if ($key === 'languages') {
            $langs_str = !empty($val) && is_array($val) ? implode(',', $val) : '';
            setcookie("{$key}_value", $langs_str, time() + 365 * 24 * 3600, '/');
        } else {
            setcookie("{$key}_value", $val, time() + 365 * 24 * 3600, '/');
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $key => $_) {
            setcookie("{$key}_error", 1, time() + 60, '/');
        }

        $first_error_field = array_key_first($errors);

        return [
            'success' => false,
            'errors' => $errors,
            'scroll_to_first_error' => $first_error_field
        ];
    }

    try {
        $db->beginTransaction();

        $birth_date = sprintf('%04d-%02d-%02d', $values['birth_year'], $values['birth_month'], $values['birth_day']);

        $stmt = $db->prepare("INSERT INTO applications 
            (full_name, phone, email, birth_date, gender, biography, agreement) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $values['fio'],
            $values['phone'],
            $values['email'],
            $birth_date,
            $values['gender'],
            $values['biography'],
            $values['agreement']
        ]);
        $app_id = $db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
        foreach ($values['languages'] as $lang_id) {
            $stmt->execute([$app_id, $lang_id]);
        }

        $login = 'user_' . bin2hex(random_bytes(3));
        $password = bin2hex(random_bytes(4));
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (login, password_hash) VALUES (?, ?)");
        $stmt->execute([$login, $hash]);

        $user_id = $db->lastInsertId();
        $stmt = $db->prepare("INSERT INTO user_applications (user_id, application_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $app_id]);

        $db->commit();

        if (!$is_ajax) {
            setcookie('save', 1, time() + 3600, '/');
            setcookie('login', $login, time() + 3600, '/');
            setcookie('password', $password, time() + 3600, '/');
        }

        return ['success' => true, 'login' => $login, 'password' => $password];

    } catch (PDOException $e) {
        $db->rollBack();
        error_log('DB Error: ' . $e->getMessage());
        return ['success' => false, 'errors' => ['db' => 'Ошибка при сохранении в БД']];
    }
}

function getErrorMessage($field, $code) {
    $messages = [
        'fio' => 'Укажите ФИО',
        'phone' => 'Укажите телефон',
        'email' => 'Укажите email',
        'birth_day' => ($code == 1) ? 'Укажите день' : 'Некорректный день',
        'birth_month' => ($code == 1) ? 'Укажите месяц' : 'Некорректный месяц',
        'birth_year' => ($code == 1) ? 'Укажите год' : 'Некорректный год',
        'gender' => 'Укажите пол',
        'biography' => 'Напишите биографию',
        'languages' => 'Выберите хотя бы один язык',
        'agreement' => 'Необходимо согласие'
    ];

    return $messages[$field] ?? 'Ошибка в поле';
}