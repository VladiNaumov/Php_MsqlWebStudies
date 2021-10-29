<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Удаление категории");
if (check_admin_user()) {
  if (isset($_POST['catid'])) {
    if(delete_category($_POST['catid'])) {
      echo "<p>Категория была удалена.</p>";
    } else {
      echo "<p>Категория не может быть удалена.<br />
            Обычно причина в том, что она не является пустой.</p>";
  } else {
    echo "<p>Категория не указана. Пожалуйста, попробуйте заново.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы, чтобы просматривать эту страницу.</p>";
}
do_html_footer();

?>
