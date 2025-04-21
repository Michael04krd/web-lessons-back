<?php
header('Content-Type: text/html; charset=UTF-8');

$user = 'u68608';
$pass = '1096993';
$db = new PDO('mysql:host=localhost;dbname=u68608', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

function getLangs($db){
  try{
    $allowed_lang=[];
    $data = $db->query("SELECT id, name FROM languages")->fetchAll();
    foreach ($data as $lang) {
      $allowed_lang[$lang['id']] = $lang['name'];
    }
    return $allowed_lang;
  } catch(PDOException $e){
    die('Error: ' . $e->getMessage());
  }
}
$allowed_lang = getLangs($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  $errors = array();
  $values = array();

  // Проверяем Cookies на наличие ошибок и значений
  $fields = ['full_name', 'phone', 'email', 'birth_day', 'birth_month', 'birth_year', 'gender', 'biography', 'languages', 'agreement'];
  foreach ($fields as $field) {
    $errors[$field] = !empty($_COOKIE[$field . '_error']);
    $values[$field] = empty($_COOKIE[$field . '_value']) ? '' : $_COOKIE[$field . '_value'];
  }

  // Удаляем Cookies с ошибками после использования
  foreach ($fields as $field) {
    setcookie($field . '_error', '', time() - 3600);
  }

  // Выводим сообщения об ошибках с подробными описаниями
  if ($errors['full_name']) {
    $messages['full_name'] = match($_COOKIE['full_name_error']) {
      '1' => 'Имя не указано.',
      '2' => 'Имя не должно превышать 128 символов.',
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

  include('form.php');
  exit();
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $errors = FALSE;

  // Получение данных
  $fio = trim($_POST['full_name'] ?? '');
  $num = trim($_POST['phone'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $day = trim($_POST['birth_day'] ?? '');
  $month = trim($_POST['birth_month'] ?? ''); 
  $year = trim($_POST['birth_year'] ?? '');
  $biography = trim($_POST['biography'] ?? '');
  $gen = $_POST['gender'] ?? '';
  $languages = is_array($_POST['languages']) ? $_POST['languages'] : [];
  $agreement = isset($_POST['agreement']) && $_POST['agreement'] === 'on' ? 1 : 0;

  // Валидация
  if (empty($fio)) {
    setcookie('full_name_error', '1', 0);
    $errors = TRUE;
  } elseif (strlen($fio) > 128) {
    setcookie('full_name_error', '2', 0);
    $errors = TRUE;
  } elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s]+$/u', $fio)) {
    setcookie('full_name_error', '3', 0);
    $errors = TRUE;
  }
  setcookie('full_name_value', $fio, time() + 365 * 24 * 60 * 60);

  if (empty($num)) {
    setcookie('phone_error', '1', 0);
    $errors = TRUE;
  } elseif (!preg_match('/^\+7\d{10}$/', $num)) {
    setcookie('phone_error', '2', 0);
    $errors = TRUE;
  }
  setcookie('phone_value', $num, time() + 365 * 24 * 60 * 60);

  if (empty($email)) {
    setcookie('email_error', '1', 0);
    $errors = TRUE;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setcookie('email_error', '2', 0);
    $errors = TRUE;
  }
  setcookie('email_value', $email, time() + 365 * 24 * 60 * 60);

  if (empty($gen)) {
    setcookie('gender_error', '1', 0);
    $errors = TRUE;
  } elseif (!in_array($gen, ["male", "female"])) {
    setcookie('gender_error', '2', 0);
    $errors = TRUE;
  }
  setcookie('gender_value', $gen, time() + 365 * 24 * 60 * 60);

  if (empty($biography)) {
    setcookie('biography_error', '1', 0);
    $errors = TRUE;
  } elseif (strlen($biography) > 512) {
    setcookie('biography_error', '2', 0);
    $errors = TRUE;
  } elseif (preg_match('/[<>{}\[\]]|<script|<\?php/i', $biography)) {
    setcookie('biography_error', '3', 0);
    $errors = TRUE;
  }
  setcookie('biography_value', $biography, time() + 365 * 24 * 60 * 60);

  if (empty($languages)) {
    setcookie('languages_error', '1', 0);
    $errors = TRUE;
  } else {
    $invalid_langs = array_diff($languages, array_keys($allowed_lang));
    if (!empty($invalid_langs)) {
      setcookie('languages_error', '2', 0);
      $errors = TRUE;
    }
  }
  setcookie('languages_value', implode(',', $languages), time() + 365 * 24 * 60 * 60);

  if (!checkdate($month, $day, $year)) {
    setcookie('birth_day_error', '1', 0);
    setcookie('birth_month_error', '1', 0);
    setcookie('birth_year_error', '1', 0);
    $errors = TRUE;
  }
  setcookie('birth_day_value', $day, time() + 365 * 24 * 60 * 60);
  setcookie('birth_month_value', $month, time() + 365 * 24 * 60 * 60);
  setcookie('birth_year_value', $year, time() + 365 * 24 * 60 * 60);

  if (!$agreement) {
    setcookie('agreement_error', '1', 0);
    $errors = TRUE;
  }
  setcookie('agreement_value', $agreement, time() + 365 * 24 * 60 * 60);

  if ($errors) {
    header('Location: index.php');
    exit();
  }

  // Сохранение в БД
  try {
    $birth_date = sprintf("%04d-%02d-%02d", $year, $month, $day);
    $stmt = $db->prepare("INSERT INTO applications (full_name, phone, email, birth_date, gender, biography, agreement) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fio, $num, $email, $birth_date, $gen, $biography, $agreement]);

    $application_id = $db->lastInsertId();
    $stmt_insert = $db->prepare("INSERT INTO application_languages (application_id, language_id) VALUES (?, ?)");
    foreach ($languages as $language_id) {
        $stmt_insert->execute([$application_id, $language_id]);
    }

    // Очищаем куки с значениями полей
    foreach ($fields as $field) {
        setcookie($field . '_value', '', time() - 3600);
    }
    setcookie('save', '1', time() + 24 * 60 * 60);
    header('Location: index.php?save=1');
    exit();
    } catch (PDOException $e) {
        die('Ошибка сохранения: ' . $e->getMessage());
    }
}
?>
