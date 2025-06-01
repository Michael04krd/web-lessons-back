<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактирование заявки</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>
    <div class="admin-container">
        <h1>Редактирование заявки #<?= htmlspecialchars($appId) ?></h1>
        <form method="POST" class="form">
            <div class="form-group">
                <label>ФИО:</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($app['full_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($app['email']) ?>" required>
            </div>

            <div class="form-group">
                <label>Телефон:</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($app['phone']) ?>">
            </div>

            <div class="form-group">
                <label>Пол:</label>
                <select name="gender">
                    <option value="male" <?= $app['gender'] === 'male' ? 'selected' : '' ?>>Мужской</option>
                    <option value="female" <?= $app['gender'] === 'female' ? 'selected' : '' ?>>Женский</option>
                </select>
            </div>

            <div class="form-group">
                <label>Языки программирования:</label>
                <select name="languages[]" multiple class="multiselect">
                    <?php foreach ($allLangs as $lang): ?>
                        <option value="<?= $lang['id'] ?>" <?= in_array($lang['id'], $selectedLangs) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($lang['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Биография:</label>
                <textarea name="biography"><?= htmlspecialchars($app['biography']) ?></textarea>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="agreement" <?= $app['agreement'] ? 'checked' : '' ?>>
                    Согласен с условиями
                </label>
            </div>

            <div class="action-buttons">
    <button type="submit" class="button">Сохранить</button>
    <a href="../modules/admin.php" class="button">Отмена</a>
     </div>
        </form>
    </div>
</body>
</html>