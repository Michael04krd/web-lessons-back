<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Форма регистрации</title>
</head>
<body>
    <div class="auth-buttons">
        <?php if (!empty($_SESSION['login'])): ?>
            <input type="button" value="Выйти" onclick="location.href='logout.php'" class="auth-btn">
        <?php else: ?>
            <input type="button" value="Войти" onclick="location.href='login.php'" class="auth-btn">
        <?php endif; ?>
    </div>

    <!-- Блок сгенерированных учетных данных -->
    <?php if (!empty($_SESSION['generated_login']) && !empty($_SESSION['generated_password']) && empty($_SESSION['login'])): ?>
        <div class="credentials">
            <h3>Ваши учетные данные:</h3>
            <p><strong>Логин:</strong> <?php echo htmlspecialchars($_SESSION['generated_login'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Пароль:</strong> <?php echo htmlspecialchars($_SESSION['generated_password'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Используйте их для входа в следующий раз.</p>
        </div>
        <?php 
            unset($_SESSION['generated_login']);
            unset($_SESSION['generated_password']);
        ?>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <h1>ФОРМА</h1>
        <?php if (!empty($messages)): ?>
        <div class="messages">
            <?php foreach ($messages as $message): ?>
                <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Поле ФИО -->
        <label for="full_name">ФИО:</label>
        <input type="text" id="full_name" name="full_name" placeholder="Введите Ваше фамилию, имя, отчество" required maxlength="150" value="<?php echo htmlspecialchars($values['full_name'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['full_name']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['full_name'])) echo '<div class="error-message">' . htmlspecialchars($messages['full_name'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Телефон -->
        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" name="phone" placeholder="+7" required value="<?php echo htmlspecialchars($values['phone'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['phone']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['phone'])) echo '<div class="error-message">' . htmlspecialchars($messages['phone'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Email -->
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Введите Вашу почту" required value="<?php echo htmlspecialchars($values['email'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['email']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['email'])) echo '<div class="error-message">' . htmlspecialchars($messages['email'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Дата рождения -->
        <label for="birth_date">Дата рождения:</label>
        <div class="date-fields">
            <input type="number" id="birth_day" name="birth_day" placeholder="День" min="1" max="31" required value="<?php echo htmlspecialchars($values['birth_day'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['birth_day']) echo 'class="error"'; ?>>
            <input type="number" id="birth_month" name="birth_month" placeholder="Месяц" min="1" max="12" required value="<?php echo htmlspecialchars($values['birth_month'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['birth_month']) echo 'class="error"'; ?>>
            <input type="number" id="birth_year" name="birth_year" placeholder="Год" min="1900" max="2100" required value="<?php echo htmlspecialchars($values['birth_year'], ENT_QUOTES, 'UTF-8'); ?>" <?php if ($errors['birth_year']) echo 'class="error"'; ?>>
        </div>
        <?php if (!empty($messages['birth_date'])) echo '<div class="error-message">' . htmlspecialchars($messages['birth_date'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Пол -->
        <label>Пол:</label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="male" required <?php if ($values['gender'] === 'male') echo 'checked'; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>>
            <label for="male">Мужской</label>
            <input type="radio" id="female" name="gender" value="female" required <?php if ($values['gender'] === 'female') echo 'checked'; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>>
            <label for="female">Женский</label>
        </div>
        <?php if (!empty($messages['gender'])) echo '<div class="error-message">' . htmlspecialchars($messages['gender'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Любимый язык программирования -->
        <label for="languages">Любимый язык программирования:</label>
        <select id="languages" name="languages[]" multiple required <?php if ($errors['languages']) echo 'class="error"'; ?>>
            <?php foreach ($allowed_lang as $id => $name): ?>
                <option value="<?php echo (int)$id; ?>" <?php if (in_array($id, explode(',', $values['languages']))) echo 'selected'; ?>><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($messages['languages'])) echo '<div class="error-message">' . htmlspecialchars($messages['languages'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Биография -->
        <label for="biography">Биография:</label>
        <textarea id="biography" name="biography" required <?php if ($errors['biography']) echo 'class="error"'; ?>><?php echo htmlspecialchars($values['biography'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        <?php if (!empty($messages['biography'])) echo '<div class="error-message">' . htmlspecialchars($messages['biography'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <!-- Поле Согласие -->
        <input type="checkbox" id="agreement" name="agreement" required <?php if ($values['agreement']) echo 'checked'; ?> <?php if ($errors['agreement']) echo 'class="error"'; ?>>
        <label for="agreement">С контрактом ознакомлен(а)</label>
        <?php if (!empty($messages['agreement'])) echo '<div class="error-message">' . htmlspecialchars($messages['agreement'], ENT_QUOTES, 'UTF-8') . '</div>'; ?><br>

        <input type="submit" value="<?php echo !empty($_SESSION['login']) ? 'Обновить данные' : 'Сохранить'; ?>">
    </form>
</body>
</html>