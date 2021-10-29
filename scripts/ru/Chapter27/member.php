<?php
 
// Включить файлы с функциями для этого приложения.
require_once('bookmark_fns.php');
session_start();
 
// Создать короткие имена переменных.
if (!isset($_POST['username']))  {
  // Если не установлена, тогда установить в фиктивное значение.
  $_POST['username'] = " "; 
}
$username = $_POST['username'];
if (!isset($_POST['passwd']))  {
  // Если не установлена, тогда установить в фиктивное значение.
  $_POST['passwd'] = " "; 
}
$passwd = $_POST['passwd'];
 
if ($username && $passwd) {
  // Пользователь только что попытался войти.
  try  {
    login($username, $passwd);
    // Если сведения о пользователе присутствуют в базе данных, 
    // тогда зарегистрировать имя пользователя.
    $_SESSION['valid_user'] = $username;
  }
  catch(Exception $e)  {
    // Безуспешный вход.
    do_html_header('Проблема:');
    echo 'Вы не смогли войти в систему.<br>
          Вы должны войти, чтобы просматривать страницу.';
    do_html_url('login.php', 'Вход');
    do_html_footer();
    exit;
  }
}
 
do_html_header('Домашняя страница');
check_valid_user();
// Извлечь закладки, сохраненные этим пользователем.
if ($url_array = get_user_urls($_SESSION['valid_user'])) {
  display_user_urls($url_array);
}
 
// Предоставить меню действий.
display_user_menu();
 
do_html_footer();
?>