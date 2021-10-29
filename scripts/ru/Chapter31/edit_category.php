<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Обновление категории");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    if(update_category($_POST['catid'], $_POST['catname'])) {
      echo "<p>Категория была обновлена.</p>";
    } else {
      echo "<p>Категория не может быть обновлена.</p>";
    }
  } else {
    echo "<p>Вы не заполнили форму. Пожалуйста, попробуйте заново.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы, чтобы просматривать эту страницу.</p>";
}
do_html_footer();

?>
