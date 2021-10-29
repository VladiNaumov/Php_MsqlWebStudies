function check_valid_user() {
// Выясняет, вошел ли пользователь, и уведомляет его, если нет.
  if (isset($_SESSION['valid_user']))  {
      echo "Вход от имени пользователя ".$_SESSION['valid_user'].".<br>";
  } else {
     // Пользователь не вошел в систему.
     do_html_heading('Проблема:');
     echo 'Вы не вошли в систему.<br>';
     do_html_url('login.php', 'Вход');
     do_html_footer();
     exit;
  }
}