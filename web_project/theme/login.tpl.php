<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="./styles/login.css">
    <title>Вход в систему</title>
  </head>
  <body>
  <h1>Вход в систему</h1>

<?php if (!empty($error)): ?>
  <div class="error-message" style="color: red; margin-bottom: 10px;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form class="login_form" action="<?php echo url('login'); ?>" method="post">
  <label> 
    Логин <br/>
    <input name="login" />
  </label> <br/>
  <label> 
    Пароль <br/>
    <input type="password" name="password" />
  </label> <br/>
  
  <input class="login_button" type="submit" value="Войти" />
  <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
</form>

  </body>
</html>