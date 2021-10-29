<?php
 
// Включить файлы с функциями для этого приложения.
require_once('bookmark_fns.php');
session_start();
$old_user = $_SESSION['valid_user'];
 
// Сохранить для проверки, если пользователь вошел ранее.
unset($_SESSION['valid_user']);
$result_dest = session_destroy();
 
// Начать вывод HTML-разметки.
do_html_header('Выход');
 
if (!empty($old_user)) {
  if ($result_dest)  {
    // Если пользователь вошел и теперь выходит.
    echo 'Вы вышли из системы.<br>';
    do_html_url('login.php', 'Вход');
  } else {
   // Пользователь вошел и не может выйти.
    echo 'Не удалось выйти из системы.<br>';
  }
} else {
  // Если пользователь не входил, но каким-то образом попал на эту страницу.
  echo 'Вы не входили в систему, поэтому не обязаны выходить из нее.<br>';
  do_html_url('login.php', 'Вход');
}
 
do_html_footer();
 
?>