<?php
  // Включить файлы функций для приложения.
  require_once('book_sc_fns.php');
  session_start();

  if (($_POST['username']) && ($_POST['passwd'])) {
    // Пользователь только что попытался войти.

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (login($username, $passwd)) {
      // Если пользователь найдет в базе данных, то зарегистрировать его имя.
      $_SESSION['admin_user'] = $username;
    } else {
      // Не удавшийся вход.
      do_html_header("Проблема:");
      echo "<p>Вы не смогли войти в систему.<br/>
            Вы должны войти, чтобы видеть страницу.</p>";
      do_html_url('login.php', 'Вход');
      do_html_footer();
      exit;
    }
  }

  do_html_header("Администрирование");
  if (check_admin_user()) {
    display_admin_menu();
  } else {
    echo "<p>Вы не авторизованы для входа в административную область.</p>";
  }
  do_html_footer();
?>