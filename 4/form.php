<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание 4</title>
</head>
<body>
    <form action="index.php" method="POST">
        <h1>ФОРМА</h1>
        <?php if (!empty($messages)): ?>
        <div class="messages">
            <button class="close-btn" onclick="this.parentElement.style.display='none'">×</button>
            <?php foreach ($messages as $message): ?>
        <div class="message"><?php echo $message; ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

        <!-- Поле ФИО -->
        <label for="full_name">ФИО:</label>
        <input type="text" id="full_name" name="full_name" placeholder="Введите Ваше фамилию, имя, отчество" required maxlength="150" value="<?php echo htmlspecialchars($values['full_name']); ?>" <?php if ($errors['full_name']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['full_name'])) echo '<div class="error-message">' . $messages['full_name'] . '</div>'; ?><br>

        <!-- Поле Телефон -->
        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" name="phone" placeholder="+7" required value="<?php echo htmlspecialchars($values['phone']); ?>" <?php if ($errors['phone']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['phone'])) echo '<div class="error-message">' . $messages['phone'] . '</div>'; ?><br>

        <!-- Поле Email -->
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Введите Вашу почту" required value="<?php echo htmlspecialchars($values['email']); ?>" <?php if ($errors['email']) echo 'class="error"'; ?>>
        <?php if (!empty($messages['email'])) echo '<div class="error-message">' . $messages['email'] . '</div>'; ?><br>

        <!-- Поле Дата рождения -->
        <label for="birth_date">Дата рождения:</label>
        <div class="date-fields">
            <input type="number" id="birth_day" name="birth_day" placeholder="День" min="1" max="31" required value="<?php echo htmlspecialchars($values['birth_day']); ?>" <?php if ($errors['birth_day']) echo 'class="error"'; ?>>
            <input type="number" id="birth_month" name="birth_month" placeholder="Месяц" min="1" max="12" required value="<?php echo htmlspecialchars($values['birth_month']); ?>" <?php if ($errors['birth_month']) echo 'class="error"'; ?>>
            <input type="number" id="birth_year" name="birth_year" placeholder="Год" min="1900" max="2100" required value="<?php echo htmlspecialchars($values['birth_year']); ?>" <?php if ($errors['birth_year']) echo 'class="error"'; ?>>
        </div>
        <?php if (!empty($messages['birth_date'])) echo '<div class="error-message">' . $messages['birth_date'] . '</div>'; ?><br>

        <!-- Поле Пол -->
        <label>Пол:</label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="male" required <?php if ($values['gender'] === 'male') echo 'checked'; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>>
            <label for="male">Мужской</label>
            <input type="radio" id="female" name="gender" value="female" required <?php if ($values['gender'] === 'female') echo 'checked'; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>>
            <label for="female">Женский</label>
        </div>
        <?php if (!empty($messages['gender'])) echo '<div class="error-message">' . $messages['gender'] . '</div>'; ?><br>

        <!-- Поле Любимый язык программирования -->
        <label for="languages">Любимый язык программирования:</label>
        <select id="languages" name="languages[]" multiple required <?php if ($errors['languages']) echo 'class="error"'; ?>>
            <?php foreach ($allowed_lang as $id => $name): ?>
                <option value="<?php echo $id; ?>" <?php if (in_array($id, explode(',', $values['languages']))) echo 'selected'; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($messages['languages'])) echo '<div class="error-message">' . $messages['languages'] . '</div>'; ?><br>

        <!-- Поле Биография -->
        <label for="biography">Биография:</label>
        <textarea id="biography" name="biography" required <?php if ($errors['biography']) echo 'class="error"'; ?>><?php echo htmlspecialchars($values['biography']); ?></textarea>
        <?php if (!empty($messages['biography'])) echo '<div class="error-message">' . $messages['biography'] . '</div>'; ?><br>

        <!-- Поле Согласие -->
        <input type="checkbox" id="agreement" name="agreement" required <?php if ($values['agreement']) echo 'checked'; ?> <?php if ($errors['agreement']) echo 'class="error"'; ?>>
        <label for="agreement">С контрактом ознакомлен(а)</label>
        <?php if (!empty($messages['agreement'])) echo '<div class="error-message">' . $messages['agreement'] . '</div>'; ?><br>

        <input type="submit" value="Сохранить">
    </form>
</body>
</html>

