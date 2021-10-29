<?php
  session_start();
 
  // Сохранить для проверки, входил ли пользователь на сайт.
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Выход</title>
</head>
<body>
<h1>Выход</h1>
<?php
  if (!empty($old_user))
  {
    echo '<p>Вы успешно вышли из сайта.</p>';
  }
  else
  {
    // Если пользователь не входил на сайт, но каким-то образом попал на эту страницу.
    echo '<p>Вы не входили на сайт, потому и не должны выходить из него.</p>';
  }
?>
<p><a href="authmain.php">Вернуться на домашнюю страницу</a></p>
 
</body>
</html>