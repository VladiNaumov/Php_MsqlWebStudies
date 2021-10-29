<?php
  require_once("bookmark_fns.php");
  do_html_header("Переустановка пароля");
 
  // Создать короткое имя переменной.
  $username = $_POST['username'];
 
  try {
    $password = reset_password($username);
    notify_password($username, $password);
    echo 'Новый пароль выслан вам по электронной почте.<br>';
  }
  catch (Exception $e) {
    echo 'Переустановить пароль не удалось - пожалуйста, повторите попытку позже.';
  }
  do_html_url('login.php', 'Вход');
  do_html_footer();
?>