<!DOCTYPE html>
<html>
<head>
   <title>Секретная страница</title>
</head>
<body>
 
<?php
  if ((!isset($_POST['name'])) || (!isset($_POST['password']))) {
  // посетитель должен ввести имя и пароль
?>
    <h1>Пожалуйста, войдите</h1>
    <p>Это секретная страница.</p>
    <form method="post" action="secret.php">
    <p><label for="name">Имя пользователя:</label> 
    <input type="text" name="name" id="name" size="15" /></p>
    <p><label for="password">Пароль:</label> 
    <input type="password" name="password" id="password" size="15" /></p>
    <button type="submit" name="submit">Войти</button>    
    </form>
<?php
  } else if(($_POST['name']=='user') && ($_POST['password']=='pass')) {
    // комбинация имени и пароля посетителя корректна
    echo '<h1>Вот она!</h1>
          <p>Бьемся об заклад, что вы безумно рады возможности видеть эту секретную страницу.</p>';
  } else {
    // комбинация имени и пароля посетителя не корректна
    echo '<h1>Уходите!</h1>
          <p>Вы не имеете права использовать этот ресурс.</p>';
  }
?>
</body>
</html>