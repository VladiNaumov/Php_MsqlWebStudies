<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();
$old_user = $_SESSION['admin_user'];  // сохранить для проверки, если пользователь вошел ранее
unset($_SESSION['admin_user']);
session_destroy();

// Начать вывод HTML-разметки.
do_html_header("Выход");

if (!empty($old_user)) {
  echo "<p>Вы вышли из системы.</p>";
  do_html_url("login.php", "Вход");
} else {
  // Если пользователь не входил, но каким-то образом попал на эту страницу.
  echo "<p>Вы не входили в систему, поэтому не обязаны выходить из нее.</p>";
  do_html_url("login.php", "Вход");
}

do_html_footer();

?>
